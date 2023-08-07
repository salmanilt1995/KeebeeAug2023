<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sync extends My_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('common/Common_model');
        $this->load->model('api/User_model');
    }



    public function addData()
    {

        $clients = $this->getValue('clients');
        $tanks = $this->getValue('tanks');
        $fills = $this->getValue('fills');
        $areas = $this->getValue('areas');
        $rentals = $this->getValue('rentals');
        $maintenance = $this->getValue('maintenance');
        $schedule = $this->getValue('schedule');
        $units = $this->getValue('units');
        $propanes = $this->getValue('propanes');
        

        $clientData = json_decode($clients, true);
        $tanksData = json_decode($tanks, true);
        $fillsData = json_decode($fills, true);
        $areasData = json_decode($areas, true);
        $rentalsData = json_decode($rentals, true);
        $maintenanceData = json_decode($maintenance, true);
        $scheduleData = json_decode($schedule, true);
        $unitsData = json_decode($units, true);
        $propanesData = json_decode($propanes, true);
        
        
  
        if(!empty($clientData)){

        if (count($clientData) > 0) {
            $query = $this->db->query("SELECT clientId from clients");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'clientId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($clientData as $item) {
                if (in_array($item['clientId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `clients` SET "
                        . "userId 		= '" . $item['userId'] . "',"
                        . "billingName 	= '" . $item['billingName'] .  "',"
                        . "contactName 	= '" . $item['contactName'] . "',"
                        . "physicalAddress 	= '" . $item['physicalAddress'] . "',"
                        . "direction 	= '" . $item['direction'] . "',"
                        . "phone 	= '" . $item['phone'] . "',"
                        . "secondPhone 	= '" . $item['secondPhone'] . "',"
                        . "area 	= '" . $item['area'] . "',"
                        . "note 	= '" . $item['note'] . "',"
                        . "shitlist 	= '" . $item['shitlist'] . "',"
                        . "prepay 	= '" . $item['prepay'] . "',"
                        . "callFirst 	= '" . $item['callFirst'] . "',"
                        . "warning 	= '" . $item['warning'] . "',"
                        . "auto 	= '" . $item['auto'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "isSync 	= '" . $item['isSync'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE clientId 	= '" . $item['clientId'] . "';";

                    if ($updateQuery != "") {
                        $clientupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `clients`(`clientId`, `userId`, `billingName`, `contactName`, `physicalAddress`, `direction`, `phone`,
                    `secondPhone`, `area`, `note`, `shitlist`, `prepay`, `callFirst`, `warning`, `auto`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`) VALUES";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['clientId']  . "',
                    '" .   $item['userId']   . "',
                    '" .   $item['billingName']   . "',
                    '" .  $item['contactName']   . "',
                    '" .   $item['physicalAddress']   . "',
                    '" .   $item['direction']   . "',
                    '" .  $item['phone']   . "',
                    '" .   $item['secondPhone']   . "',
                    '" .   $item['area']   . "',
                    '" .   $item['note']   . "',
                    '" .  $item['shitlist']   . "',
                    '" . $item['prepay']   . "',
                    '" .  $item['callFirst']   . "',
                    '" .  $item['warning']   . "',
                    '" .  $item['auto']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" .  $item['isSync']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $clientInsert = $this->db->query($clientQuery);
            }
        }
        }


        if(!empty($tanksData)){
            
        if (count($tanksData) > 0) {
            $query = $this->db->query("SELECT tankId from tanks");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'tankId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($tanksData as $item) {
                if (in_array($item['tankId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `tanks` SET "
                        . "tankId 		= '" . $item['tankId'] . "',"
                        . "clientId 	= '" . $item['clientId'] .  "',"
                        . "userId 	= '" . $item['userId'] . "',"
                        . "billingName 	= '" . $item['billingName'] . "',"
                        . "tankType 	= '" . $item['tankType'] . "',"
                        . "ownership 	= '" . $item['ownership'] . "',"
                        . "tankSize 	= '" . $item['tankSize'] . "',"
                        . "description 	= '" . $item['description'] . "',"
                        . "unit 	= '" . $item['unit'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "isSync 	= '" . $item['isSync'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE tankId 	= '" . $item['tankId'] . "';";

                    if ($updateQuery != "") {
                        $tankupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `tanks`(`tankId`, `clientId`, `userId`, `billingName`, `tankType`, `ownership`, `tankSize`, `unit`, `description`,
                         `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`) VALUES";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['tankId']  . "',
                    '" .   $item['clientId']   . "',
                    '" .   $item['userId']   . "',
                    '" .  $item['billingName']   . "',
                    '" .   $item['tankType']   . "',
                    '" .   $item['ownership']   . "',
                    '" .  $item['tankSize']   . "',
                    '" .   $item['unit']   . "',
                    '" .   $item['description']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" .  $item['isSync']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $tankInsert = $this->db->query($clientQuery);
            }
        }
        }

        if(!empty($fillsData)){
            
        if (count($fillsData) > 0) {
            $query = $this->db->query("SELECT fillId from fills");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'fillId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($fillsData as $item) {
                if (in_array($item['fillId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `fills` SET "
                        . "fillId 		= '" . $item['fillId'] . "',"
                        . "userId 	= '" . $item['userId'] .  "',"
                        . "clientId 	= '" . $item['clientId'] . "',"
                        . "tankId 	= '" . $item['tankId'] . "',"
                        . "percentage 	= '" . $item['percentage'] . "',"
                        . "volume 	= '" . $item['volume'] . "',"
                        . "isGift 	= '" . $item['isGift'] . "',"
                        . "price 	= '" . $item['price'] . "',"
                        . "calendar 	= '" . $item['calendar'] . "',"
                        . "note 	= '" . $item['note'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "isSync 	= '" . $item['isSync'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "lpd 	= '" . $item['lpd'] . "', "
                        . "dlf 	= '" . $item['dlf'] . "', "
                        . "p20 	= '" . $item['p20'] . "', "
                        . "po 	= '" . $item['po'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE fillId 	= '" . $item['fillId'] . "';";

                    if ($updateQuery != "") {
                        $fillsupdated =  $this->db->query($updateQuery);
                    }
                } else {
                     $fillsquery = $this->db->query("SELECT * from fills where tankId = '".$item['tankId']."' and calendar = '".$item['calendar']."' order by createdAt desc");
                     $fillsrow =  $fillsquery->row();
                    //  print($this->db->last_query());exit;
                     if(empty($fillsrow)){
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `fills`(`fillId`, `userId`, `clientId`, `tankId`, `percentage`, `volume`, `isGift`, `price`, `calendar`, `note`,
                         `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `lpd`, `dlf`, `p20`, `po`, `deviceId`) VALUES";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['fillId']  . "',
                    '" .   $item['userId']   . "',
                    '" .   $item['clientId']   . "',
                    '" .  $item['tankId']   . "',
                    '" .   $item['percentage']   . "',
                    '" .   $item['volume']   . "',
                    '" .   $item['isGift']   . "',
                    '" .  $item['price']   . "',
                    '" .   $item['calendar']   . "',
                    '" .   $item['note']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" .  $item['isSync']   . "',
                    '" .  $item['deleted']   . "',
                    '" .  $item['lpd']   . "',
                    '" .  $item['dlf']   . "',
                    '" .  $item['p20']   . "',
                    '" . $item['po']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $fillsInsert = $this->db->query($clientQuery);
            }
        }
        }
        
         if(!empty($areasData)){
             
        if (count($areasData) > 0) {
            $query = $this->db->query("SELECT areaId from areas");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'areaId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($areasData as $item) {
                if (in_array($item['areaId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `areas` SET "
                        . "areaId 		= '" . $item['areaId'] . "',"
                        . "userID 	= '" . $item['userID'] .  "',"
                        . "areaName 	= '" . $item['areaName'] . "',"
                        . "quadrantName 	= '" . $item['quadrantName'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "isSync 	= '" . $item['isSync'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt']  . "', "
                        . "deviceId 	= '" . $item['deviceId']  . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE areaId 	= '" . $item['areaId'] . "';";

                    if ($updateQuery != "") {
                        $areasupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `areas`(`areaId`, `userID`, `areaName`, `quadrantName`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`) VALUES";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['areaId']  . "',
                    '" .   $item['userID']   . "',
                    '" .   $item['areaName']   . "',
                    '" .  $item['quadrantName']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" .  $item['isSync']   . "',
                    '" .  $item['deleted']   . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $areasInsert = $this->db->query($clientQuery);
            }
        }
        }

        if (!empty($rentalsData)) {
            
        if (count($rentalsData) > 0) {
            $query = $this->db->query("SELECT rentalId from rentals");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'rentalId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($rentalsData as $item) {
                if (in_array($item['rentalId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `rentals` SET "
                        . "rentalId 		= '" . $item['rentalId'] . "',"
                        . "userId 		= '" . $item['userId'] . "',"
                        . "billingName 	= '" . $item['billingName'] .  "',"
                        . "truckNumber 	= '" . $item['truckNumber'] .  "',"
                        . "date 	= '" . $item['date'] . "',"
                        . "datedeliver 	= '" . $item['datedeliver'] . "',"
                        . "renewal_month 	= '" . $item['renewal_month'] . "',"
                        . "rental 	= '" . $item['rental'] . "',"
                        . "size 	= '" . $item['size'] . "',"
                        . "sn 	= '" . $item['sn'] . "',"
                        . "al 	= '" . $item['al'] . "',"
                        . "note 	= '" . $item['note'] . "',"
                        . "prv 	= '" . $item['prv'] . "',"
                        . "previousRenter 	= '" . $item['previousRenter'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "isReturn 	= '" . $item['isReturn'] . "', "
                        . "isSync 	= '" . $item['isSync'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE rentalId 	= '" . $item['rentalId'] . "';";

                    if ($updateQuery != "") {
                        $rentalsupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `rentals`(`rentalId`,`userId`, `billingName`, `truckNumber`, `date`, `datedeliver`, `renewal_month`, `rental`, `size`, `sn`, `al`, `note`, `prv`, `previousRenter`,
                         `createdAt`, `updatedAt`, `isActive`, `deleted`, `isReturn`, `isSync`, `deviceId`) VALUES";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['rentalId']  . "',
                    '" .   $item['userId']   . "',
                    '" .   $item['billingName']   . "',
                    '" .   $item['truckNumber']   . "',
                    '" .   $item['date']   . "',
                    '" .   $item['datedeliver']   . "',
                    '" .  $item['renewal_month']   . "',
                    '" .  $item['rental']   . "',
                    '" .  $item['size']   . "',
                    '" .  $item['sn']   . "',
                    '" .  $item['al']   . "',
                    '" .  $item['note']   . "',
                    '" .  $item['prv']   . "',
                    '" .  $item['previousRenter']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['isReturn']  . "',
                    '" . $item['isSync']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $rentalsInsert = $this->db->query($clientQuery);
            }
        }
        }


        if (!empty($maintenanceData)) {
        if (count($maintenanceData) > 0) {
            $query = $this->db->query("SELECT maintenanceId from maintenance");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'maintenanceId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($maintenanceData as $item) {
                if (in_array($item['maintenanceId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `maintenance` SET "
                        . "maintenanceId 		= '" . $item['maintenanceId'] . "',"
                        . "userId 	= '" . $item['userId'] .  "',"
                        . "unitId 	= '" . $item['unitId'] .  "',"
                        . "km 	= '" . $item['km'] . "',"
                        . "hours 	= '" . $item['hours'] . "',"
                        . "litres 	= '" . $item['litres'] . "',"
                        . "lkms 	= '" . $item['lkms'] . "',"
                        . "total 	= '" . $item['total'] . "',"
                        . "dates 	= '" . $item['dates'] . "',"
                        . "notes 	= '" . $item['notes'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "isSync 	= '" . $item['isSync'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE maintenanceId 	= '" . $item['maintenanceId'] . "';";

                    if ($updateQuery != "") {
                        $maintenanceupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `maintenance`(`maintenanceId`, `userId`, `unitId`,`km`, `hours`, `litres`, `lkms`, `total`, `dates`, `notes`,
                         `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`, `deviceId`) VALUES";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['maintenanceId']  . "',
                    '" .   $item['userId']   . "',
                    '" .   $item['unitId']   . "',
                    '" .   $item['km']   . "',
                    '" .  $item['hours']   . "',
                    '" .  $item['litres']   . "',
                    '" .  $item['lkms']   . "',
                    '" .  $item['total']   . "',
                    '" .  $item['dates']   . "',
                    '" .  $item['notes']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['isSync']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $maintenanceInsert = $this->db->query($clientQuery);
            }
        }
        }

        if (!empty($scheduleData)) {
            
        if (count($scheduleData) > 0) {
            $query = $this->db->query("SELECT scheduleId from schedule");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'scheduleId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($scheduleData as $item) {
                if (in_array($item['scheduleId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `schedule` SET "
                        . "scheduleId 		= '" . $item['scheduleId'] . "',"
                        . "clientId 	= '" . $item['clientId'] .  "',"
                        . "userId 	= '" . $item['userId'] .  "',"
                        . "tankId 	= '" . $item['tankId'] . "',"
                        . "isSync 	= '" . $item['isSync'] . "',"
                        . "month 	= '" . $item['month'] . "',"
                        . "year 	= '" . $item['year'] . "',"
                        . "boxId 	= '" . $item['boxId'] . "',"
                        . "notes 	= '" . $item['notes'] . "',"
                        . "cId 	= '" . $item['cId'] . "',"
                        . "tId 	= '" . $item['tId'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "',"
                        . "deleted 	= '" . $item['deleted'] . "',"
                        . "isActive 	= '" . $item['isActive'] . "',"
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE scheduleId 	= '" . $item['scheduleId'] . "';";

                    if ($updateQuery != "") {
                        $scheduleupdated =  $this->db->query($updateQuery);
                    }
                } else {
                   
                     $schedulequery = $this->db->query("SELECT * from schedule where tankId = '".$item['tankId']."' and deleted=0 order by createdAt asc");
                     $schedulerow =  $schedulequery->row();
                    //  print($this->db->last_query());exit;
                     if(empty($schedulerow)){
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `schedule`(`scheduleId`, `clientId`, `userId`, `tankId`, `isSync`, `month`, `year`, `cId`, `tId`, `boxId`, `notes`, `createdAt`,
                         `updatedAt`, `isActive`, `deleted`, `deviceId`) VALUES ";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['scheduleId']  . "',
                    '" .   $item['clientId']   . "',
                    '" .   $item['userId']   . "',
                    '" .   $item['tankId']   . "',
                    '" .  $item['isSync']   . "',
                    '" .  $item['month']   . "',
                    '" .  $item['year']   . "',
                    '" .  $item['cId']   . "',
                    '" .  $item['tId']   . "',
                    '" .  $item['boxId']   . "',
                    '" .  $item['notes']   . "',
                    '" . $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $scheduleInsert = $this->db->query($clientQuery);
            }
        }
        }
   
            if (!empty($unitsData)) {
                
            if (count($unitsData) > 0) {
            $query = $this->db->query("SELECT unitId from units");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'unitId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($unitsData as $item) {
                if (in_array($item['unitId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `units` SET "
                        . "unitId 		= '" . $item['unitId'] . "',"
                        . "userId 	= '" . $item['userId'] .  "',"
                        . "unit 	= '" . $item['unit'] .  "',"
                        . "typeofvehicle 	= '" . $item['typeofvehicle'] . "',"
                        . "model 	= '" . $item['model'] . "',"
                        . "vin 	= '" . $item['vin'] . "',"
                        . "tareweight 	= '" . $item['tareweight'] . "',"
                        . "grossweight 	= '" . $item['grossweight'] . "',"
                        . "oilchangeschedule 	= '" . $item['oilchangeschedule'] . "',"
                        . "greaseschedule 	= '" . $item['greaseschedule'] . "',"
                        . "notes 	= '" . $item['notes'] . "',"
                        . "createdAt 	= '" . $item['createdAt'] . "', "
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "isActive 	= '" . $item['isActive'] . "', "
                        . "isSync 	= '" . $item['isSync'] . "', "
                        . "deleted 	= '" . $item['deleted'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE unitId 	= '" . $item['unitId'] . "';";

                    if ($updateQuery != "") {
                        $unitsupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `units`(`unitId`, `userId`, `unit`, `typeofvehicle`, `model`, `vin`, `tareweight`, `grossweight`, `oilchangeschedule`, `greaseschedule`,
                         `notes`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`) VALUES ";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['unitId']  . "',
                    '" .   $item['userId']   . "',
                    '" .   $item['unit']   . "',
                    '" .   $item['typeofvehicle']   . "',
                    '" .  $item['model']   . "',
                    '" .  $item['vin']   . "',
                    '" .  $item['tareweight']   . "',
                    '" .  $item['grossweight']   . "',
                    '" . $item['oilchangeschedule']   . "',
                    '" .  $item['greaseschedule']   . "',
                    '" .  $item['notes']   . "',
                    '" .  $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" .  $item['isSync']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $unitsInsert = $this->db->query($clientQuery);
            }
        }
        }
        
        
        if (!empty($propanesData)) {
                
            if (count($propanesData) > 0) {
            $query = $this->db->query("SELECT propaneId from propanes");
            $clientArray =  $query->result_array();

            if (count($clientArray) > 0)
                $clientArray = array_column($clientArray, 'propaneId');


            $updateQuery = '';
            $clientQueryss = '';
            $clientQuery = '';

            $i = 0;
            foreach ($propanesData as $item) {
                if (in_array($item['propaneId'], $clientArray)) {
                    // Update Records
                    $updateQuery = "UPDATE `propanes` SET "
                        . "propaneId 		= '" . $item['propaneId'] . "',"
                        . "userId 		= '" . $item['userId'] . "',"
                        . "propaneName 	= '" . $item['propaneName'] .  "',"
                        . "createdAt 	= '" . $item['createdAt'] . "', "
                        . "updatedAt 	= '" . $item['updatedAt'] . "', "
                        . "isActive 	= '" . $item['isActive'] . "', "
                        . "isSync 	= '" . $item['isSync'] . "', "
                        . "deviceId 	= '" . $item['deviceId'] . "', "
                        . "deleted 	= '" . $item['deleted'] . "', "
                        . "syncDate 	= '" . Date('Y-m-d H:i:s') . "' "
                        . "WHERE propaneId 	= '" . $item['propaneId'] . "';";

                    if ($updateQuery != "") {
                        $propanesupdated =  $this->db->query($updateQuery);
                    }
                } else {
                    if ($i == 0) {
                        $clientQuery .= "INSERT INTO `propanes`(`propaneId`, `userId`, `propaneName`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`) VALUES ";
                    }
                    // Insert Records
                    $clientQueryss .= " ( 
                    '" . $item['propaneId']  . "',
                    '" . $item['userId']  . "',
                    '" .   $item['propaneName']   . "',
                    '" .  $item['createdAt']   . "',
                    '" .  $item['updatedAt']   . "',
                    '" .  $item['isActive']   . "',
                    '" .  $item['isSync']   . "',
                    '" . $item['deleted']  . "',
                    '" . $item['deviceId']  . "'),";
                    $i++;
                }
            }
            $clientQuery .= rtrim($clientQueryss, ', ');

            if ($clientQuery != "") {
                $propanesInsert = $this->db->query($clientQuery);
            }
        }
        }




        if (@$propanesupdated == TRUE || @$propanesInsert == TRUE || @$unitsupdated == TRUE || @$unitsInsert == TRUE || @$scheduleupdated == TRUE || @$scheduleInsert == TRUE || @$maintenanceInsert == TRUE || @$maintenanceupdated == TRUE || @$clientupdated == TRUE || @$clientInsert == TRUE || @$tankInsert == TRUE || @$tankupdated == TRUE || @$fillsInsert == TRUE || @$fillsupdated == TRUE || @$areasInsert == TRUE || @$areasupdated == TRUE  || @$rentalsInsert == TRUE || @$rentalsupdated == TRUE) {
           
            $this->success_response_body('Data Sync Successfully', true);
        } else {
            $this->error_response_body(ERR_DATA_PROCESSING_ERROR);
        }
    }

    public function getdata()
    {

        $type = $this->Validator('type');
        $user_id = $this->Validator('user_id');
        if ($type == 'clients') {
            $data = $this->Common_model->getData('clients','`clientId`, `userId`, `billingName`, `contactName`, `physicalAddress`, `direction`, `phone`, `secondPhone`, `area`, `note`, `shitlist`, `prepay`, `callFirst`, `warning`, `auto`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`, `deviceId`','userId',$user_id);
        } else if ($type == 'tanks') {
            $data = $this->Common_model->getData('tanks','`tankId`, `clientId`, `userId`, `billingName`, `tankType`, `ownership`, `tankSize`, `unit`, `description`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`, `deviceId`','userId',$user_id);
        } else if ($type == 'fills') {
            $data = $this->Common_model->getData('fills',' `fillId`, `userId`, `clientId`, `tankId`, `percentage`, `volume`, `isGift`, `price`, `calendar`, `note`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `lpd`, `dlf`, `p20`, `po`, `isSync`, `deviceId`','userId',$user_id);
        } else if ($type == 'areas') {
            $data = $this->Common_model->getData('areas','`areaId`, `userID`, `areaName`, `quadrantName`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`, `deviceId`','userID',$user_id);
        } else if ($type == 'rentals') {
            $data = $this->Common_model->getData('rentals',' `rentalId`, `billingName`, `userId`, `truckNumber`, `date`, `datedeliver`, `renewal_month`, `rental`, `size`, `sn`, `al`, `note`, `prv`, `previousRenter`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isReturn`, `isSync`, `deviceId`','userId',$user_id);
        } else if ($type == 'maintenance') {
            $data = $this->Common_model->getData('maintenance','`maintenanceId`, `userId`, `unitId`, `km`, `hours`, `litres`, `lkms`, `total`, `dates`, `notes`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`, `deviceId`','userId',$user_id);
        } else if ($type == 'schedule') {
            $data = $this->Common_model->getData('schedule','`scheduleId`, `clientId`, `tankId`, `userId`, `isSync`, `month`, `year`, `cId`, `tId`, `boxId`, `notes`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `deviceId`','userId',$user_id);
        }else if ($type == 'units'){
            $data = $this->Common_model->getData('units','`unitId`, `userId`, `unit`, `typeofvehicle`, `model`, `vin`, `tareweight`, `grossweight`, `oilchangeschedule`, `greaseschedule`, `notes`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`','userId',$user_id);
        }else{
            $data = $this->Common_model->getData('propanes','`propaneId`, `userId`, `propaneName`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`, `deviceId`','userId',$user_id);
        }
        
        if ($type != '') {
            unset($data["syncDate"]);
            $this->success_response_body(
               ucfirst($type) . ' list get Successfully',
                true,
                array(
                    'data' => $data
                )
            );
        } else {
            $this->error_response_body('Recode not found!');
        }
    }
    public function syncHistory()
    {

        $user_id = $this->Validator('user_id');
        $device_id = $this->Validator('device_id');
        $this->Common_model->delete('sync_history','user_id',$user_id,'device_id',$device_id);

        $array = array(
            'user_id' => $user_id,
            'device_id' => $device_id,
        );
        $insert = $this->Common_model->insertdata('sync_history',$array);
        if ($insert != '') {
            $this->success_response_body(
               'Sync Successfully',
            );
        } else {
            $this->error_response_body('Sync failed!');
        }

    }

    public function getList(){
        $user_id = $this->Validator('user_id');
        $device_id = $this->Validator('device_id'); 

        
            $clients = $this->Common_model->getDataOther('clients','`clientId`, `userId`, `billingName`, `contactName`, `physicalAddress`, `direction`, `phone`, `secondPhone`, `area`, `note`, `shitlist`, `prepay`, `callFirst`, `warning`, `auto`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'clientId');
       
            $tanks = $this->Common_model->getDataOther('tanks','`tankId`, `clientId`, `userId`, `billingName`, `tankType`, `ownership`, `tankSize`, `unit`, `description`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'tankId');
        
            $fills = $this->Common_model->getDataOther('fills',' `fillId`, `userId`, `clientId`, `tankId`, `percentage`, `volume`, `isGift`, `price`, `calendar`, `note`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `lpd`, `dlf`, `p20`, `po`, `isSync`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'fillId');
            
            $areas = $this->Common_model->getDataOther('areas','`areaId`, `userID`, `areaName`, `quadrantName`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`,`deviceId`','userID',$user_id,'deviceId' , $device_id,'areaId');
       
            $rentals = $this->Common_model->getDataOther('rentals',' `rentalId`, `billingName`, `userId`, `truckNumber`, `date`, `datedeliver`, `renewal_month`, `rental`, `size`, `sn`, `al`, `note`, `prv`, `previousRenter`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isReturn`, `isSync`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'rentalId');
        
            $maintenance = $this->Common_model->getDataOther('maintenance','`maintenanceId`, `userId`,unitId`, `km`, `hours`, `litres`, `lkms`, `total`, `dates`, `notes`, `createdAt`, `updatedAt`, `isActive`, `deleted`, `isSync`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'maintenanceId');
       
            $schedule = $this->Common_model->getDataOther('schedule','`scheduleId`, `clientId`, `userId`, `tankId`, `isSync`, `month`, `cId`, `tId`, `year`, `boxId`, `notes`, `createdAt`, `updatedAt`, `notes`, `isActive`, `deleted`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'scheduleId');

            $units = $this->Common_model->getDataOther('units','`unitId`, `userId`, `unit`, `typeofvehicle`, `model`, `vin`, `tareweight`, `grossweight`, `oilchangeschedule`, `greaseschedule`, `notes`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'unitId');
            
            
            $propanes = $this->Common_model->getDataAll('propanes','`propaneId`, `userId`, `propaneName`, `createdAt`, `updatedAt`, `isActive`, `isSync`, `deleted`,`deviceId`','userId',$user_id,'deviceId' , $device_id,'propaneId');
        
        // foreach($fills as $key => $value){

        //     $fills[$key]->price = (double)$value->price;
        //     $fills[$key]->percentage = (double)$value->percentage;
        //     $fills[$key]->volume = (double)$value->volume;
        //     $fills[$key]->dlf = (int)$value->dlf;
        // }
        
        $data['clients'] = $clients;
        $data['tanks'] = $tanks;
        $data['fills'] = $fills;
        $data['areas'] = $areas;
        $data['rentals'] = $rentals;
        $data['maintenance'] = $maintenance;
        $data['schedule'] = $schedule;
        $data['units'] = $units;
        $data['propanes'] = $propanes;

        if ($data) {
            unset($data["syncDate"]);
            $this->success_response_body(
               'Data get Successfully',
                true,
                array(
                    'data' => $data
                )
            );
        } else {
            $this->error_response_body('Recode not found!');
        }


    }
}
