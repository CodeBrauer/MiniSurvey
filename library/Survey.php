<?php

/**
* Main Controller
*/
class Survey
{

    public function __construct()
    {
        $this->db      = new Database();
        $this->auth    = new Auth();
        $this->session = new Session();
    }

    public function auth()
    {
        $data['title'] = "Login / Register";
        if (isset($_POST['form'])) {
            if ($_POST['form'] == 'login') {
                $login       = $this->auth->auth($_POST['username'], $_POST['password']);
                $data['msg'] = $login;
                if ($login[0] === true) {
                    $this->session->set('logged_in', true);
                    $this->session->set('user_id', $this->auth->getUserData($_POST['username'])['id']);
                    $this->session->set('username', $_POST['username']);
                    header('Location: /index');
                }
            }

            if ($_POST['form'] == 'register') {
                $register    = $this->auth->register($_POST['username'], $_POST['password']);
                $data['msg'] = $register;
            }
        }
        return $data;
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: /index');
    }

    public function index()
    {
        $data['title'] = "Choose your survey";
        $data['list']  = $this->db->query('SELECT s.id,title,s.created,username FROM surveys s JOIN users u ON s.created_by = u.id');

        if ($data['list'] === false)
            $data['list'] = [];

        $_my_answers = $this->db->query("SELECT survey FROM answers WHERE created_by = '" . $this->session->get('user_id') . "'");
        $my_answers = [];

        if (!empty($_my_answers)) {
            array_walk_recursive($_my_answers, function($a) use (&$my_answers) {
                $my_answers[] = $a;
            });
        }

        foreach ($data['list'] as $key => $list) {
            if (in_array($list['id'], $my_answers)) {
                $data['list'][$key]['answered'] = $this->db->query("SELECT created from answers WHERE created_by = '".$this->session->get('user_id')."' AND survey = '".$list['id']."'", true)['created'];
            } else {
                $data['list'][$key]['answered'] = false;
            }
        }
        return $data;
    }

    public function create()
    {
        $data['title'] = "Create your survey";

        if (!$this->auth->isAdmin($this->session->get('user_id'))) {
// throw new Exception("User is not an administrator");
            die('<strong>User is not an administrator - please leave.</strong><br>(You can make yourself an admin if you have access to the database)');
        }

        if (isset($_POST['title']) && isset($_POST['option'])) {
            $this->db->insert('surveys', [
                'title'      => trim($_POST['title']),
                'created_by' => $this->session->get('user_id')
                ]);
            $survey_id = $this->db->pdo->lastInsertId();

            foreach ($_POST['option'] as $option) {
                if (empty($option)) {
                    continue;
                }
                $this->db->insert('survey_options', [
                    'survey'   => $survey_id,
                    'question' => trim($option)
                    ]);
            }

            header('Location: /survey/' . $survey_id);
        }

        return $data;
    }

    public function survey($id = false)
    {
        if ($id === false || empty($id)) {
            die('No ID given.');
        }
        $_id = $this->db->pdo->quote($id);

        if (isset($_POST['go'])) {
            $user_id      = $this->session->get('user_id');
            $answered = $this->db->query("SELECT COUNT(id) as `count`, created FROM answers WHERE survey = '$id' AND created_by = '$user_id'", true);
            $has_answered = (bool)$answered['count'];

            if ($has_answered) {
                $data['msg'] = "You've already voted for this post (@ " . date('d.m.Y H:i:s', strtotime($answered['created']) ) . ")";
            } else {
                $result      = $this->db->insert('answers', [
                    'survey'     => $id,
                    'value'      => $_POST['answer'],
                    'created_by' => $this->session->get('user_id')
                    ]);
                $data['msg'] = ($result) ? 'Your vote safely arrived.' : 'Database Error. Please try again!';

                //-cookie- $cookie_value = json_encode(['answered' => time(), 'survey_id' => $id, 'answer_id' => $_POST['answer']]);
                // check this line after unix timestamp overflow (2038)
                //-cookie- setcookie("survey_answered[$id]", $cookie_value, pow(2, 31), '/');
            }
        }

        $data['survey']    = $this->db->query('SELECT * FROM surveys WHERE id =' . $_id, true);
        $data['questions'] = $this->db->query('SELECT * FROM survey_options WHERE survey =' . $_id);

        if (!$data['survey']) {
            header('Location: /404');
        }

        $data['title']        = $data['survey']['title'];
        $data['results_link'] = "/results/$id";
        return $data;
    }

    public function results($id)
    {
        if ($id === false || empty($id)) {
            // @todo make this prettier 
            die('No ID given.');
        }

        $_id = $this->db->pdo->quote($id);

        $data['survey']    = $this->db->query('SELECT * FROM surveys WHERE id =' . $_id, true);

        if (!$data['survey']) {
            header('Location: /404');
        }

        $data['questions'] = $this->db->query('SELECT * FROM survey_options WHERE survey =' . $_id);
        $data['answers']   = $this->db->query('SELECT * FROM answers WHERE survey =' . $_id);
        $data['votes']     = $this->db->query('SELECT a.value AS vote , s.question FROM survey_options s
            LEFT JOIN answers a
            ON s.id = a.value
            WHERE s.survey='. $_id);

        $data['title'] = 'Results: ' . $data['survey']['title'];

        $_votes  = [];
        $noVotes = [];
        foreach ($data['votes'] as $value) {
            if ($value['vote'] !== NULL) {
                $_votes[] = $value['question'];
            } else {
                $noVotes[$value['question']] = 0;
            }
        }

        $data['votes'] = array_count_values($_votes);
        arsort($data['votes']);
        $data['votes'] = $data['votes'] + $noVotes;

        return $data;
    }

    public function _404($value='')
    {
        
    }
}