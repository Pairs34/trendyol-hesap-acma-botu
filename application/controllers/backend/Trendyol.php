<?php


class Trendyol extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_login') != true) {
            redirect(route('login.home'));
        }
    }

    public function index()
    {
        $data = [
            'view' => 'backend/trendyol',
            'hesaplar' => $this->db->get("hesaplar")->result()
        ];
        $this->load->view("backend/layout", $data);
    }

    public function delete_account($id){
        $this->db->where("hesap_id",$id)->delete("hesaplar");
        redirect(route('trendyol.home'));
    }
    public function araclar()
    {
        $data = [
            'view' => 'backend/araclar',
            'ucak_modu' => $this->db->where("id", 1)->get("ucak_modu")->row(),
            'hesaplar' => $this->db->get("hesaplar")->result()
        ];
        $this->load->view("backend/layout", $data);
    }

    public function ucak_guncelle()
    {
        $data = array(
            'x' => $this->input->post("x"),
            'y' => $this->input->post("y")
        );

        $check = $this->db->where("id", 1)->update("ucak_modu", $data);
        if ($check) {
            redirect(route('trendyol.araclar'));
        }
    }

    public function randomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateRandomToken()
    {
        return $this->randomString(8) . "-" . $this->randomString(4) . "--" . $this->randomString(4) . "-" . $this->randomString(4) . "-" . $this->randomString(13);
    }

    public function airplane_mode()
    {
        $ucak_modu = $this->db->where("id", 1)->get("ucak_modu")->row();
        shell_exec(__DIR__ . '\adb\adb.exe shell input tap ' . $ucak_modu->x . ' ' . $ucak_modu->y . '');
        sleep(3);
        shell_exec(__DIR__ . '\adb\adb.exe shell input tap ' . $ucak_modu->x . ' ' . $ucak_modu->y . '');
        sleep(3);
    }

    public function generateAccount()
    {
        $password = $this->input->post("password");
        $count = $this->input->post("account_count");
        $ucak_mod = $this->input->post("ucak_mod") == "on" ? 1 : 0;
        for ($i = 0; $i <= $count; $i++) {
            if ($ucak_mod == 1){
                $this->airplane_mode();
            }
            $email = $this->randomString(rand(5, 10)) . "@gmail.com";
            $payload = array(
                'guestToken' => '',
                'preferences' =>
                    array(
                        0 =>
                            array(
                                'id' => 0,
                                'isAccept' => true,
                            ),
                    ),
                'regulation' =>
                    array(
                        'isConditionOfMembershipApproved' => true,
                        'isProtectionOfPersonalDataApproved' => true,
                    ),
                'user' =>
                    array(
                        'email' => $email,
                        'gender' => 2,
                        'password' => $password,
                        'storeFrontId' => '1',
                        'userType' => 'MEMBER',
                    ),
            );
            $headers = [
                "Host" => "loginapp.trendyol.com",
                "X-Storefront-Id" => "1",
                "X-Application-Id" => "5",
                "User-Agent" => "Dalvik/2.1.0 (Linux; U; Android 7.1.1; ONEPLUS A5000 Build/NMF26X) Trendyol/5.10.3.521",
                'Build' => "5.10.3.521",
                "Platform" => "Android",
                "Gender" => "F",
                "Searchsegment" => "31",
                "Deviceid" => $this->generateRandomToken(),
                "Pid" => $this->generateRandomToken(),
                "Sid" => $this->generateRandomToken(),
                "X-Features" => "REBATE_ENABLED",
                "Accept-Language" => "tr-TR",
                "Uniqueid" => $this->randomString(16),
                "Content-Type" => "application/json; charset=UTF-8",
                "Accept-Encoding" => "gzip, deflate",
                "Connection" => "close"
            ];
            $api_url = "https://loginapp.trendyol.com/register/user";
            try {
                $client = new GuzzleHttp\Client([
                    'headers' => $headers
                ]);
                $request = $client->post($api_url, [
                    "json" => $payload
                ]);
                $jsonData = json_decode($request->getBody());

                $insertData = array(
                    'email' => $email,
                    'password' => $password,
                    'accessToken' => $jsonData->accessToken,
                    'refreshToken' => $jsonData->refreshToken
                );

                $check = $this->db->insert("hesaplar", $insertData);
            } catch (RuntimeException $e) {
                echo "Hata";
                if ($e instanceof ClientException) {
                    echo "Hata";
                } else if ($e instanceof RequestException) {
                    echo "Hata";
                }
            }


        }
        redirect(route('trendyol.home'));
    }

    public function saveCollection()
    {
        $collectionID = $this->input->post("collectionID");
        $save_count = $this->input->post("save_count");
        $hesaplar = $this->db->limit($save_count)->get("hesaplar")->result();
        $ucak_mod = $this->input->post("ucak_mod") == "on" ? 1 : 0;
        if ($hesaplar){
            if ($save_count <= count($hesaplar)){
                foreach ($hesaplar as $hesap){
                    if ($ucak_mod == 1){
                        $this->airplane_mode();
                    }
                    $headers = [
                        "Host" => "browsingpublic-mdc.trendyol.com",
                        "X-Storefront-Id" => "1",
                        "X-Application-Id" => "5",
                        "User-Agent" => "Dalvik/2.1.0 (Linux; U; Android 7.1.1; ONEPLUS A5000 Build/NMF26X) Trendyol/5.10.3.521",
                        "Authorization" => "bearer " . $hesap->accessToken,
                        'Build' => "5.10.3.521",
                        "Platform" => "Android",
                        "Gender" => "F",
                        "Searchsegment" => "31",
                        "Deviceid" => $this->generateRandomToken(),
                        "Pid" => $this->generateRandomToken(),
                        "Sid" => $this->generateRandomToken(),
                        "X-Features" => "REBATE_ENABLED",
                        "Accept-Language" => "tr-TR",
                        "Uniqueid" => $this->randomString(16),
                        "Content-Type" => "application/json; charset=UTF-8",
                        "Accept-Encoding" => "gzip, deflate",
                        "Connection" => "close"
                    ];

                    $api_url = "https://browsingpublic-mdc.trendyol.com/mobile-zeus-zeussocial-service/zeus/mycollections/" . $collectionID . "/follow";
                    try {
                        $client = new GuzzleHttp\Client([
                            'headers' => $headers
                        ]);
                        $request = $client->post($api_url, []);
                        if ($request->getStatusCode() == 201) {
                            //echo "Başarılı";
                        }

                    } catch (RuntimeException $e) {
                        echo "Hata";
                        if ($e instanceof ClientException) {
                            echo "Hata";
                        } else if ($e instanceof RequestException) {
                            echo "Hata";
                        }
                    }
                }
                redirect(route('trendyol.araclar'));
            }else{
                redirect(route('trendyol.araclar'));
            }
        }else{
            redirect(route('trendyol.araclar'));
        }

    }

    public function followSeller()
    {
        $sellerID = $this->input->post("sellerID");
        $save_count = $this->input->post("save_count");
        $hesaplar = $this->db->limit($save_count)->get("hesaplar")->result();
        $ucak_mod = $this->input->post("ucak_mod") == "on" ? 1 : 0;
        if ($hesaplar){
            if ($save_count <= count($hesaplar)){
                foreach ($hesaplar as $hesap){
                    if ($ucak_mod == 1){
                        $this->airplane_mode();
                    }
                    $headers = [
                        "Host" => "browsingpublic-sdc.trendyol.com",
                        "X-Storefront-Id" => "1",
                        "X-Application-Id" => "5",
                        "User-Agent" => "Dalvik/2.1.0 (Linux; U; Android 7.1.1; ONEPLUS A5000 Build/NMF26X) Trendyol/5.10.3.521",
                        "Authorization" => "bearer " . $hesap->accessToken,
                        'Build' => "5.10.3.521",
                        "Platform" => "Android",
                        "Gender" => "F",
                        "Searchsegment" => "31",
                        "Deviceid" => $this->generateRandomToken(),
                        "Pid" => $this->generateRandomToken(),
                        "Sid" => $this->generateRandomToken(),
                        "X-Features" => "REBATE_ENABLED",
                        "Accept-Language" => "tr-TR",
                        "Uniqueid" => $this->randomString(16),
                        "Content-Type" => "application/json; charset=UTF-8",
                        "Accept-Encoding" => "gzip, deflate",
                        "Connection" => "close"
                    ];
                    $api_url = "https://browsingpublic-sdc.trendyol.com/mobile-zeus-zeussocial-service/zeus/sellers/" . $sellerID . "/follow";
                    try {
                        $client = new GuzzleHttp\Client([
                            'headers' => $headers
                        ]);
                        $request = $client->post($api_url, []);
                        $jsonData = json_decode($request->getBody());

                        if ($jsonData->followStatus == 1) {
                            echo "Başarılı";
                        }
                    } catch (RuntimeException $e) {
                        echo "Hata";
                        if ($e instanceof ClientException) {
                            echo "Hata";
                        } else if ($e instanceof RequestException) {
                            echo "Hata";
                        }
                    }

                }
                redirect(route('trendyol.araclar'));
            }else{
                redirect(route('trendyol.araclar'));
            }
        }else{
            redirect(route('trendyol.araclar'));
        }




    }


}