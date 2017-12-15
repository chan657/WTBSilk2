<?php
/** 
 * SMS component for CakePHP using the Clickatell HTTP API interface. 
 * @author Doug Bromley <doug.bromley@gmail.com> 
 * @copyright Doug Bromley 
 * @link http://www.cakephp.org CakePHP 
 * @link http://www.clickatell.com Clickatell 
 * 
 * This program is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation, either version 3 of the License, or 
 * (at your option) any later version. 

 * This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
 * GNU General Public License for more details. 
 * You should have received a copy of the GNU General Public License 
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 */ 

class SmsComponent extends Component {
  
     public function send_sms($authKey,$mobileNumber,$message,$senderId,$route){
              $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        
        //API URL
        $url="http://54.254.130.116/sendhttp.php";
        
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        
        //get response
        $output = curl_exec($ch);
        
        curl_close($ch);
        
        return $output;
      
     }
  
     
 
} 