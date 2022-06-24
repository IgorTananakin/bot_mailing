<?php

class DBManager
{
    public $db;

    public function __construct(MysqliDb $db)
    {
        $this->db = $db;
    }

    public function isUser($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        if (isset($result['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function addUser($user_id, $name)
    {
        $db = $this->db;
        $content = array('user_id' => $user_id, 'name' => $name);
        $id = $db->insert('users', $content);
        return $id;
    }

    public function getCmd($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['cmd'];
    }

    public function setCmd($user_id, $cmd)
    {
        $db = $this->db;
        $content = array('cmd' => $cmd);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getReferrals($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['referrals'];
    }

    public function setReferrals($user_id, $referrals)
    {
        $db = $this->db;
        $content = array('referrals' => $referrals);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getName($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['name'];
    }

    public function getRefer($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['refer'];
    }

    public function setRefer($user_id, $refer)
    {
        $db = $this->db;
        $content = array('refer' => $refer);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getLang($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['lang'];
    }

    public function setLang($user_id, $lang)
    {
        $db = $this->db;
        $content = array('lang' => $lang);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getUsername($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['username'];
    }

    public function setUsername($user_id, $username)
    {
        $db = $this->db;
        $content = array('username' => $username);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getBonus($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['bonus'];
    }

    public function setBonus($user_id, $bonus)
    {
        $db = $this->db;
        $content = array('bonus' => $bonus);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function CountReferrals($user_id)
    {
        $db = $this->db;
        $result = $db->where('refer', $user_id)->get('users');
        return count($result);
    }

    public function getAllUsers()
    {
        $db = $this->db;
        $result = $db->get('users');
        return $result;
    }

    public function getAllUsersByLang($lang = 'ru')
    {
        $db = $this->db;
        $result = $db->where('lang', $lang)->get('users');
        return $result;
    }

}