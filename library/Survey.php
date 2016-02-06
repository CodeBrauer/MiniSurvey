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
        $data['title'] = "Umfrageauswahl";
        $data['list']  = $this->db->query('SELECT * FROM surveys');
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
            $result = $this->db->insert('answers', ['survey' => $id, 'value' => $_POST['answer']]);
            $data['msg'] = ($result) ? 'Ihre Stimme wurde erfolgreich gespeichert!' : 'Datenbankfehler! Bitte versuchen Sie es später erneut.';
        }

        $data['survey']  = $this->db->query('SELECT * FROM surveys WHERE id =' . $_id, true);
        $data['questions'] = $this->db->query('SELECT * FROM survey_questions WHERE survey =' . $_id);

        $data['title'] = $data['survey']['title'];
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
        
        $data['title'] = 'Ergebnisse: ' . $data['survey']['title'];

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