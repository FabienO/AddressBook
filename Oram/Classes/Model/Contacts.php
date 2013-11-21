<?php
/**
 * Created by PhpStorm.
 * User: fab
 * Date: 20/11/13
 * Time: 12:36
 */

namespace Classes\Model;

use Classes\Model\Adapters\Pdo;

class Contacts {
    protected $db;

    public function __construct()
    {
        $this->db = new Pdo(DSN, DB_USER, DB_PASS);
    }

    /**
     * Required params for contacts
     *
     * @param array $contacts
     * @return bool
     * @throws \Exception
     */
    protected function validateContact(array $contacts = array())
    {
        $required_fields = array('first_name', 'last_name', 'type');
        $errors = array();
        $error_string = '';

        foreach($required_fields as $r) {
            if(!isset($contacts[$r]) || $contacts[$r] == '')
            {
                $errors[] = $r;
                $error_string .= $r . ', ';
            }
        }

        if(!empty($errors)) {
            throw new \Exception('Missing required fields:'. $error_string);
        }

        return true;
    }

    /**
     * Add new contact to DB
     *
     * @param array $contact
     * @return mixed
     */
    public function addContact(array $contact = array())
    {
        $this->validateContact($contact);

        try
        {
            return $this->db->insert("INSERT INTO contacts(first_name, last_name, type) VALUES(:first_name, :last_name, :type)", $contact);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Ensure contact ID is available
     *
     * @param null $contact_id
     * @throws \Exception
     */
    private function checkContactIdSet($contact_id = null)
    {
        if($contact_id === null)
        {
            throw new \Exception('Contact ID not present');
        }
    }

    /**
     * Fetch contact from DB
     *
     * @param null $contact_id
     * @return mixed
     */
    public function getContact($contact_id = null)
    {
        $this->checkContactIdSet($contact_id);

        try
        {
            return $this->db->GetRow("SELECT * FROM contacts WHERE id = :id", array('id' => $contact_id));
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Update contact
     *
     * @param null $contact_id
     * @param array $contact
     * @return mixed
     */
    public function updateContact($contact_id = null,  array $contact = array())
    {
        $this->validateContact($contact);
        $this->checkContactIdSet($contact_id);

        try
        {
            return $this->db->update("UPDATE contacts SET first_name=:first_name, last_name=:last_name, type=:type WHERE id = :id", $contact);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Add new contact address
     *
     * @param array $contactInfo
     * @return mixed
     */
    public function addContactInfo(array $contactInfo = array())
    {
        $this->checkContactIdSet($contactInfo['contact_id']);

        try
        {
            return $this->db->insert("INSERT INTO contact_info(contact_id, street_1, street_2, city, county_state, zip_post_code, country, home_tel, mobile_tel) VALUES(:contact_id, :street_1, :street_2, :city, :county_state, :zip_post_code, :country, :home_tel, :mobile_tel)", $contactInfo);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Fetch contact address
     *
     * @param null $contact_id
     * @return mixed
     */
    public function getContactInfo($contact_id = null)
    {
        $this->checkContactIdSet($contact_id);

        try
        {
            return $this->db->GetRow("SELECT * FROM contact_info WHERE contact_id = :id", array('id' => $contact_id));
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Update contact address
     *
     * @param null $contact_id
     * @param array $contactInfo
     * @return mixed
     */
    public function updateContactInfo($contact_id = null,  array $contactInfo = array())
    {
        $this->checkContactIdSet($contact_id);

        try
        {
            return $this->db->update("UPDATE contact_info SET street_1=:street_1, street_2=:street_2, city=:city, county_state=:county_state, zip_post_code=:zip_post_code, country=:country, home_tel=:home_tel, mobile_tel=:mobile_tel WHERE contact_id=:contact_id", $contactInfo);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Search for contacts
     *
     * @param null $term
     * @return array|bool
     */
    public function search($term = null)
    {
        $results = array();
        try
        {
            $terms = array('search1' => $term, 'search2' => $term, 'search3' => $term);
            $results = $this->db->search("SELECT * FROM contacts WHERE first_name LIKE :search1 OR last_name LIKE :search2 OR type LIKE :search3;", $terms);
            if(!empty($results))
            {
                return $results;
            }
            else
            {
                try
                {
                    $terms = array('search1' => $term, 'search2' => $term, 'search3' => $term, 'search4' => $term, 'search5' => $term, 'search6' => $term, 'search7' => $term, 'search8' => $term);
                    $contacts = $this->db->search("SELECT contact_id FROM contact_info WHERE home_tel LIKE :search1 OR mobile_tel LIKE :search2 OR street_1 LIKE :search3 OR street_2 LIKE :search4 OR city LIKE :search5 OR county_state LIKE :search6 OR zip_post_code LIKE :search7 OR country LIKE :search8;", $terms);
                    if(!empty($contacts))
                    {
                        $contact_ids = array();
                        foreach($contacts as $c)
                        {
                            $contact_ids[] = $c['contact_id'];
                        }
                        $inQuery = implode(',', array_fill(0, count($contact_ids), '?'));

                        return $this->db->inQuery("SELECT * FROM contacts WHERE id IN ($inQuery)", $contact_ids);
                    }
                    else
                    {
                        return false;
                    }
                }
                catch(\Exception $e)
                {
                    echo $e->getMessage();
                }
            }
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Quick edit address information
     *
     * @param null $contact_id
     * @param null $field
     * @param null $value
     * @return mixed
     */
    public function quickEdit($contact_id = null, $field = null, $value = null)
    {
        $this->checkContactIdSet($contact_id);

        try
        {
            return $this->db->update("UPDATE contact_info SET $field=:$field WHERE contact_id=:contact_id", array($field => $value, 'contact_id' => $contact_id));
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Delete contact
     *
     * @param $contact_id
     * @return mixed
     */
    public function delete($contact_id)
    {
        $this->checkContactIdSet($contact_id);

        try
        {
            return $this->db->delete("DELETE FROM contacts WHERE id = :id LIMIT 1", array('id' => $contact_id));
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }
} 