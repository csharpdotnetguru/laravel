<?php


		echo "Test 1<br>";
	  //if (getenv('HTTP_CLIENT_IP'))
         echo getenv('HTTP_CLIENT_IP');
      //if(getenv('HTTP_X_FORWARDED_FOR'))
	  echo "Test 2<br>";
         echo getenv('HTTP_X_FORWARDED_FOR');
      //if(getenv('HTTP_X_FORWARDED'))
	  echo "Test 3<br>";
         echo getenv('HTTP_X_FORWARDED');
      //if(getenv('HTTP_FORWARDED_FOR'))
	  echo "Test 4<br>";
         echo getenv('HTTP_FORWARDED_FOR');
      //if(getenv('HTTP_FORWARDED'))
	  echo "Test 5<br>";
        echo getenv('HTTP_FORWARDED');
      //if(getenv('REMOTE_ADDR'))
	  echo "Test 6<br>";
         echo getenv('REMOTE_ADDR');
		 
		 
		 
		 