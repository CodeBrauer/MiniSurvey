<?php

/**
* Main Controller
*/
class Survey
{

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $data['title'] = "Choose your survey";
        $data['list']  = $this->db->query('SELECT * FROM surveys');
        foreach ($data['list'] as $key => $list) {
            if (isset($_COOKIE['survey_answered'][$list['id']])) {
                $data['list'][$key]['answered'] = json_decode($_COOKIE['survey_answered'][$list['id']])->answered;
            } else {
                $data['list'][$key]['answered'] = false;
            }
        }
        return $data;
    }

    public function create()
    {
        die('Not implemented yet.');
    }

    public function survey($id = false)
    {
        if ($id === false || empty($id)) {
            die('No ID given.');
        }
        $_id = $this->db->pdo->quote($id);

        if (isset($_POST['go'])) {
            if (isset($_COOKIE['survey_answered'][$id])) {
                $data['msg'] = "You've already voted for this post (@ " . date('d.m.Y H:i:s', json_decode($_COOKIE['survey_answered'][$id])->answered) . ")";
            } else {
                $result      = $this->db->insert('answers', ['survey' => $id, 'value' => $_POST['answer']]);
                $data['msg'] = ($result) ? 'Your vote safely arrived.' : 'Database Error. Please try again!';
                
                $cookie_value = json_encode(['answered' => time(), 'survey_id' => $id, 'answer_id' => $_POST['answer']]);
                // check this line after unix timestamp overflow (2038)
                setcookie("survey_answered[$id]", $cookie_value, pow(2, 31), '/');
            }
        }

        $data['survey']    = $this->db->query('SELECT * FROM surveys WHERE id =' . $_id, true);
        $data['questions'] = $this->db->query('SELECT * FROM survey_questions WHERE survey =' . $_id);

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
        $data['questions'] = $this->db->query('SELECT * FROM survey_questions WHERE survey =' . $_id);
        $data['answers']   = $this->db->query('SELECT * FROM answers WHERE survey =' . $_id);
        $data['votes']     = $this->db->query('SELECT a.value AS vote , s.question FROM survey_questions s
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