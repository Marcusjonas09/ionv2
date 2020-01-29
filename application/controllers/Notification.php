<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model');
    }

    public function get_notif_badge()
    {
        $notif = $this->Notification_model->get_notif_badge();
        echo $notif;
    }

    public function get_last_login()
    {
        $notif = $this->Notification_model->get_last_login();
        echo json_encode($notif);
    }

    public function get_latest_notifications()
    {
        $notif = $this->Notification_model->get_latest_notifications();
        echo json_encode($notif);
    }

    public function get_notif()
    {
        $notifs['notifications'] = $this->Notification_model->get_notif();
        echo json_encode($notifs);
    }

    public function get_all_notif_count()
    {
        $notif = $this->Notification_model->get_all_notif_count();
        echo $notif;
    }

    // =======================================================================================
    // Petition Notifications
    // =======================================================================================

    public function send_notification($recipient, $message, $link)
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '8a5cfc7f91e3ec8112f4',
            'e5e5c5534c2aa13bb349',
            '880418',
            $options
        );

        $notif_details = array(
            'notif_sender' => $this->session->acc_number,
            'notif_sender_name' => $this->session->Firstname . ' ' . $this->session->Lastname,
            'notif_recipient' => $recipient,
            'notif_content' => $message,
            'notif_link' => $link,
            'notif_created_at' => time()
        );

        $this->Notification_model->notify($notif_details);

        $announcement['message'] = $message;
        $announcement['recipient'] = $recipient;
        $announcement['link'] = $link;
        $pusher->trigger('my-channel', 'client_specific', $announcement);
    }
}
