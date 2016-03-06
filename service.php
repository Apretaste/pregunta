<?php

class Pregunta extends Service
{
  const API_ENDPOINT = "https://ask-a-cuban.herokuapp.com/";

	public function _main(Request $request)
	{
    return $this->_list($request);
  }

	/**
	 * Function executed when the service is called
	 * 
	 * @param Request
	 * @return Response
	 * */
	public function _list(Request $request)
	{
    // LIST THE TOP 10 QUESTIONS

    $api_res = file_get_contents(self::API_ENDPOINT . "items.json");
    $json_resp = json_decode($api_res);

    $responseContent = array(
      "items" => $json_resp
    );

		// create a json object to send to the template
		// create the response
		$response = new Response();
		$response->setResponseSubject("Pregunta Top 10 Questions");
		$response->createFromTemplate("list.tpl", $responseContent);
		return $response;
	}

	public function _show(Request $request)
	{
    // SHOW A QUESTION AND TOP RECENT COMMENTS
    $api_res = file_get_contents(self::API_ENDPOINT . "/items/" . $request->query . "/item_comments.json");
    $json_resp = json_decode($api_res);

    $responseContent = array(
      "item" => $json_resp
    );

		// create a json object to send to the template
		// create the response
		$response = new Response();
		$response->setResponseSubject("Latest Answers to Question #" . $request->query);
		$response->createFromTemplate("show.tpl", $responseContent);
		return $response;
  }

	public function _find(Request $request)
	{
    // SEARCH QUESTIONS BY STRING
  }

	public function _answer(Request $request)
	{
    $data = array("item_comment" => array("content" => $request->body));
    $data_string = json_encode($data);                                                                                   
                                                                                                                     
    $ch = curl_init(self::API_ENDPOINT . "/items/" . $request->query . "/item_comments?username=" . $request->email);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',                                                                                
      'Content-Length: ' . strlen($data_string))                                                                       
    );

    $result = curl_exec($ch);

		// create a json object to send to the template
		// create the response
		return new Response();
  }

	public function _ask(Request $request)
	{
    $data = array("item" => array("title" => $request->query));
    $data_string = json_encode($data);                                                                                   
                                                                                                                     
    $ch = curl_init(self::API_ENDPOINT . "/items?username=" . $request->email);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
      'Content-Type: application/json',                                                                                
      'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   
                                                                                                                     
    $result = curl_exec($ch);

		// create a json object to send to the template
		// create the response
		return new Response();
  }
}
