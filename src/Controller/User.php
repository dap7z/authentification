<?php namespace App\Controller;

final class UserController extends AbstractController
{
    
    public function queryDB($request, $response, $params)
    {
        $users = $this->db->table('users')->lists('name');
        $this->debugger->addMessage($this->db->table('users')->find(1));
        $this->debugger->addMessage($this->db->query('App:User')->find(2));
        foreach ($users as $u) {
            $this->debugger->addMessage($u);
        }
        return $this->view->render($response, 'master.twig', [
            'name' => 'and watch the users.'
        ]);
    }
	
}
