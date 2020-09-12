<?php

class MY_Controller extends CI_Controller
{

    var $current_url;
    var $related_objects = array();
    var $current_uuid = null;
    var $payload = null;

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Africa/Lagos');
        $this->payload = new stdClass();
        $this->check_is_logged_in();
        $this->set_page_title();

        //https://stackoverflow.com/questions/27390793/sql-server-2008-returns-memory-limit-of-10240-kb-exceeded-for-buffered-query

        ini_set('memory_limit', '1280M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
        ini_set('sqlsrv.ClientBufferMaxKBSize', '524288'); // Setting to 512M
        ini_set('pdo_sqlsrv.client_buffer_max_kb_size', '524288'); // Setting to 512M - for pdo_sqlsrv

    }

    function check_is_logged_in()
    {
        if ($this->session->logged_in == TRUE || is_cli()) {
            //Carry out operations for logged in users
            //check permission , workflow computations
        } else {
            redirect(base_url() . 'auth');
        }
    }

    function check_permission()
    {
        $controller = ucfirst($this->router->fetch_class()); // controller
        $method = $this->router->fetch_method(); // method

        $access_string = $controller . '/' . $method;
        if ($this->match_resource($access_string, $this->session->access_grants)) {
            log_message('debug', $this->session->username . " From: " . $this->session->location . " accessed: " . $access_string . " Access granted! ");
        } else {
            log_message('debug', $this->session->username . " From: " . $this->session->location . " accessed: " . $access_string . " Access denied! ");
            $this->session->set_flashdata('accessdenied_message', "Sorry, you do not have access to : " . $method . " function on " . $controller);
            redirect(base_url() . 'accessdenied');
        }
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function set_page_title()
    {
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        $this->payload->page_title = ''; //initialize 
        switch ($controller) {
            case 'dashboard': //Dashboard controller
                $this->payload->page_title = 'Dashboard';
                break;
            case 'uploadoutlets': //upload outlets data
                $this->payload->page_title = 'Upload Outlets Data';
                break;
            case 'uploadrefdata': //Upload reference data
                $this->payload->page_title = 'Upload Reference Data';
                break;
            case 'viewconsents': //View Consent
                $this->payload->page_title = 'Lookup Consent Documents';
                break;
            case 'reports': //View Consent
                $this->payload->page_title = 'Reports';
                break;

            case 'compliance': //View Consent
                $this->payload->page_title = 'Compliance';
                break;

            case 'removedata': //Remove Data
                $this->payload->page_title = 'Remove Data';
                break;

            case 'settings': //Settings Controller
                switch ($method) {
                    case 'manageusers':
                        $this->payload->page_title = 'Manage Users';
                        break;
                    default:
                        $this->payload->page_title = 'Settings';
                        break;
                }
                break;

            case 'outlets': //Settings Controller
                switch ($method) {
                    case 'index':
                        $this->payload->page_title = 'List Outlets';
                        break;
                    case 'upload':
                        $this->payload->page_title = 'Upload Outlets';
                        break;
                    default:
                        $this->payload->page_title = 'Settings';
                        break;
                }
                break;

            default:
                break;
        }
    }
}
