<?php 
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Guzzle_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $ceks 	 = $this->session->userdata('token_katamaran');

		if(!isset($ceks)) {
			$userID = 1;
            $token = 'a';
		} else {
            $userID = $this->session->userdata('id_user');
            $token = $this->session->userdata('token_katamaran');
		}
        

        $this->_client = new Client([
            'base_uri' => 'localhost/api_app_divim/index.php/',
            'headers' => [
                'Client-Service' => 'frontend-client',
                'Auth-Key' => 'simplerestapi',
                'Content-Type' => 'application/json',
                'User-ID' => $userID,
                'Authorization' => $token
               ]
        ]);
    }

    // Model User
    public function getAllUser()
    {
        $response = $this->_client->request('GET', 'User');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getUserById($id)
    {
        $response = $this->_client->request('GET', 'User/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }



    public function createUser($data)
    {
        $response = $this->_client->request('POST', 'User/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateUser($id, $data)
    {
        $response = $this->_client->request('PUT', 'User/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteUser($id)
    {
        $response = $this->_client->request('DELETE', 'User/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

     // Model Agenda
    public function getAllAgenda()
    {
        $response = $this->_client->request('GET', 'Agenda');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAllZona()
    {
        $response = $this->_client->request('GET', 'Zona');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAllDataITK()
    {
        $response = $this->_client->request('GET', 'Izintinggal');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }



    public function getDataByNoPaspor($no_paspor)
    {
        $response = $this->_client->request('GET', 'Izintinggal/getDataByNoPaspor/' . $no_paspor);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }



    public function getZonaByID()
    {
        $response = $this->_client->request('GET', 'Zona');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }



    public function getAgendaByTanggal($tgl)
    {
        $response = $this->_client->request('GET', 'Agenda/agendaByTanggal/' . $tgl);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getizintinggalByZona($zona_id)
    {
        $response = $this->_client->request('GET', 'Izintinggal/izintinggalByZona/' . $zona_id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getizintinggalAllForCount()
    {
        $response = $this->_client->request('GET', 'Izintinggal/izintinggalAllForCount' );
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getizintinggalAll()
    {
        $response = $this->_client->request('GET', 'Izintinggal' );
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }



    public function getDataZonaByID($zona_id)
    {
        $response = $this->_client->request('GET', 'Zona/zonaByID/' . $zona_id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }



    public function getizintinggalByStatusandZonaID($zona_id,$status)
    {
        $response = $this->_client->request('GET', 'Izintinggal/izintinggalByStatusandZonaID/' . $zona_id.'/'.$status);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getizintinggalAllByStatus($status)
    {
        $response = $this->_client->request('GET', 'Izintinggal/izintinggalAllByStatus/' .$status);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getZona()
    {
        $response = $this->_client->request('GET', 'Zona/zonaAll/');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaByRangeTanggal($tgl1, $tgl2)
    {
        $response = $this->_client->request('GET', 'Agenda/agendaByRangeTanggal/' . $tgl1 . '/' . $tgl2);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDataITKByRangeTanggal($tgl1, $tgl2)
    {
        $response = $this->_client->request('GET', 'Zonadata/dataITKByRangeTanggal/' . $tgl1 . '/' . $tgl2);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaMingguLalu()
    {
        $response = $this->_client->request('GET', 'Agenda/agendaMingguLalu');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaMingguIni()
    {
        $response = $this->_client->request('GET', 'Agenda/agendaMingguIni');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaMingguDepan()
    {
        $response = $this->_client->request('GET', 'Agenda/agendaMingguDepan');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaBulanLalu()
    {
        $response = $this->_client->request('GET', 'Agenda/agendaBulanLalu');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaBulanIni()
    {
        $response = $this->_client->request('GET', 'Agenda/agendaBulanIni');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaBulanDepan()
    {
        $response = $this->_client->request('GET', 'Agenda/agendaBulanDepan');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAgendaById($id)
    {
        $response = $this->_client->request('GET', 'Agenda/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }


    public function getDataITKById($id)
    {
        $response = $this->_client->request('GET', 'Zonadata/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createDataITK($data)
    {
        $response = $this->_client->request('POST', 'Zonadata/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }


    public function createAgenda($data)
    {
        $response = $this->_client->request('POST', 'Agenda/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;

    }

    public function updateAgenda($id, $data)
    {
        $response = $this->_client->request('PUT', 'Agenda/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }


    public function updateDataITK($id, $data)
    {
        $response = $this->_client->request('PUT', 'Zonadata/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteFile($id, $data)
    {
        $response = $this->_client->request('POST', 'Agenda/deleteFile/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteAgenda($id)
    {
        $response = $this->_client->request('DELETE', 'Agenda/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteDataITK($id)
    {
        $response = $this->_client->request('DELETE', 'Zonadata/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Bahan Berita
    public function getAllBahanBerita()
    {
        $response = $this->_client->request('GET', 'BahanBerita');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getBahanBeritaById($id)
    {
        $response = $this->_client->request('GET', 'BahanBerita/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createBahanBerita($data)
    {
        $response = $this->_client->request('POST', 'BahanBerita/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateBahanBerita($id, $data)
    {
        $response = $this->_client->request('PUT', 'BahanBerita/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteBahanBerita($id)
    {
        $response = $this->_client->request('DELETE', 'BahanBerita/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getBahanBeritaByTanggal($tgl)
    {
        $response = $this->_client->request('GET', 'BahanBerita/bahanBeritaByTanggal/' . $tgl);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}