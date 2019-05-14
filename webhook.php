<?php
// clé API du Bot à modifier
define('TOKEN', 'XXXXXXXXXXXXXXXXXXXXXX');
// récupération des données envoyées par Telegram
$content = file_get_contents('php://input');                                 
$update = json_decode($content, true);

// l'utilisateur contacte le bot
if(preg_match('/^\/start/', $update['message']['text'])) {                       
	sendMessage($update['message']['chat']['id'], 'Bonjour '.$update['message']['from']['username'].' !');
}
// l'utilisateur envoie la commande : /gps Paris
else if(preg_match('/^\/gps/', $update['message']['text'])) {                    
	$ville = preg_replace('/^\/gps /', '', $update['message']['text']);
    $jsonOSM = file_get_contents('https://nominatim.openstreetmap.org/search?format=json&q='.urlencode($ville));
    $jsonOSM = json_decode($jsonOSM, true);                                      
	$gps = $jsonOSM[0]['display_name'].' : '.$jsonOSM[0]['lat'].','.$jsonOSM[0]['lon'];                                                    sendMessage($update['message']['chat']['id'], $gps);                             
	}
else if(preg_match('/^Bonjour|hello|plop|jr/i', $update['message']['text']))
	{
		sendMessage($update['message']['chat']['id'], 'BELIN MONGOL');
	}

else if(preg_match('/bouchon/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'Rappel pour arriver à l heure malgré les bouchons : partir plus tôt');
}

else if(preg_match('/got|game of thrones|spoil/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'Spoil et je te viole');
}

else if(preg_match('/normand/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'Oh mon petit Nico, j aimerais revenir en UCF/PI <3 ');
}
else if(preg_match('/astreinte/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'MOI AUSSI JE VEUX LE FRIC');
}
else if(preg_match('/bite/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'AHAHAH BITE');   
}
else if(preg_match('/sylvie/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'RADASSE');
}                                                                            
else if(preg_match('/basic fit/i', $update['message']['text'])) {
		sendMessage($update['message']['chat']['id'], 'Pas pour moi, j ai admis que c etait foutu');
}
else if(preg_match('/nico|nicolas/i', $update['message']['text'])) {                 
	sendMessage($update['message']['chat']['id'], 'Lequel PD?');
}
else if(preg_match('/js|jean seb|jeanseb/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'ROUX');               
}
else if(preg_match('/charles/i', $update['message']['text'])) { 
	sendMessage($update['message']['chat']['id'], 'Comment vont tes filles?');
}
else if(preg_match('/mathieu/i', $update['message']['text'])) {
	sendMessage($update['message']['chat']['id'], 'On préfère sa mère.');
}
else if(preg_match('/thibault/i', $update['message']['text'])) {
	sendMessage($update['message']['chat']['id'], 'On va le faire couiner le panda, et sa mère avec.');
}                                                                            
else if(preg_match('/rudy/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'prout ahah');         
		}
else if(preg_match('/allou/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'ALLOU ARCHER FEEDS MONGOL');
}
else if(preg_match('/maxime/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'on dit maQUEssime');
}                                                                            
else if(preg_match('/chat/i', $update['message']['text'])) {
        sendMessage($update['message']['chat']['id'], 'miaou');              
	}
else if(preg_match('/gay/i', $update['message']['text'])) {                          
	sendMessage($update['message']['chat']['id'], 'gay comme JS');
}                                                                            
else if(preg_match('/romain/i', $update['message']['text'])) {                       
	sendMessage($update['message']['chat']['id'], 'Je crois que son coloc veut le serrer palapapapalala');
}
else if($update['message']['from']['username']=="Zugzwangs") {
        sendMessage($update['message']['chat']['id'], 'IMPOSTEUR');
}

// fonction qui envoie un message à l'utilisateur
function sendMessage($chat_id, $text) {
    $q = http_build_query([
        'chat_id' => $chat_id,
        'text' => $text
        ]);
    file_get_contents('https://api.telegram.org/bot'.TOKEN.'/sendMessage?'.$q);
    }
