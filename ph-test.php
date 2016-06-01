<!-- <html>
<head>
<title></title>
</head>
<body>
-->
<?php

/*
$postData = array(
										   'client_id' => '73de357a9c1d2c845bb64e5366ebb88f0eafcd0d4b57e8dc46704c86c7ab87bf',
										   'client_secret' => '84c9aeb807ebf3fa85fd4b56997795f94ac3c4b6249059b5fc9bda401ab07160',
										   'grant_type' => 'client_credentials'
										   
										);
										//API URL
										$url="https://api.producthunt.com/v1/oauth/token";

										// init the resource
										$ch = curl_init();
										curl_setopt_array($ch, array(
										    CURLOPT_URL => $url,
										    CURLOPT_RETURNTRANSFER => true,
										    CURLOPT_POST => true,
										    CURLOPT_POSTFIELDS => $postData
										    
										));



										curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


										$output = curl_exec($ch);


										if(curl_errno($ch))
										{
										    return  'error:' . curl_error($ch);
										}

										curl_close($ch);

										echo $output;
				
*/
										/*$postData = array(
										   'client_id' => '73de357a9c1d2c845bb64e5366ebb88f0eafcd0d4b57e8dc46704c86c7ab87bf',
										   'client_secret' => '84c9aeb807ebf3fa85fd4b56997795f94ac3c4b6249059b5fc9bda401ab07160',
										   'grant_type' => 'client_credentials'
										   
										);*/
										//API URL
/*
									for($i=1;$i<=7;$i++)
									{
										$url="https://api.producthunt.com/v1/posts?days_ago=".$i;

										// init the resource
										$ch = curl_init();
										curl_setopt_array($ch, array(
										    CURLOPT_URL => $url,
										    CURLOPT_RETURNTRANSFER => true,
										    CURLOPT_POST => false
										    //CURLOPT_POSTFIELDS => $postData
										    
										));



										curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
										$headers = array();
										$headers[] = 'Accept: application/json';
										$headers[] = 'Content-Type: application/json';
										$headers[] = 'Authorization:Bearer 8bc0b4189238acbace6c85c50cffff8a3e8a90d8b8bc48b4f5b9fb75737c5ec8';
										$headers[] = 'Host: api.producthunt.com';
										


										curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
										$output = curl_exec($ch);


										if(curl_errno($ch))
										{
										    return  'error:' . curl_error($ch);
										}

										curl_close($ch);

										//var_dump(json_decode($output));
										//echo '<br><br><br>------<br>';
										$posts=array();
										$tagline=array();
										$thumbnail=array();
										$j_arr = json_decode($output,true);

										 $posts[]=$j_arr['posts'][$i]['name'];
										$tagline[]= $j_arr['posts'][$i]['tagline'];
										 $thumbnail[]=$j_arr['posts'][$i]['thumbnail']['image_url'];
										}

										?>
										<div class="listing">
										<?php
										for($i=0;$i<3;$i++)
										{
											
										echo "<br>---<br>";
										
										}
										
										?>
										<div class="show_more_main" id="show_more_main<?php echo $last_id; ?>">

										<span id="<?php echo $last_id; ?>" class="show_more" title="Load more posts">Show more</span>

        <span class="loding" style="display: none;"><span class="loding_txt">Loading....</span></span>
										</div>
										
										</div>
										<?php
										
				

			//6f9eb16898d004524806b69e00e035bfc9c82a82db0e7722995efd9155f53b33
			//14717 - startup stash id	
			//56730 - human for slack	3780137 - greaer id				
?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'ph-load-more.php',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.listing').append(html);
            }
        }); 
    });
});
</script>
*/
function multiRequest($data, $options = array()) {
 
  // array of curl handles
  $curly = array();
  // data to be returned
  $result = array();
 
  // multi handle
  $mh = curl_multi_init();
 
  // loop through $data and create curl handles
  // then add them to the multi-handle
  foreach ($data as $id => $d) {
 
    $curly[$id] = curl_init();
 
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    curl_setopt($curly[$id], CURLOPT_URL,            $url);
   // curl_setopt($curly[$id], CURLOPT_HEADER,         0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curly[$id], CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curly[$id], CURLOPT_SSL_VERIFYPEER, 0);
	$headers = array();
	$headers[] = 'Accept: application/json';
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Authorization:Bearer 8bc0b4189238acbace6c85c50cffff8a3e8a90d8b8bc48b4f5b9fb75737c5ec8';
	$headers[] = 'Host: api.producthunt.com';
										


	curl_setopt($curly[$id], CURLOPT_HTTPHEADER, $headers);
 
     //post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST,       0);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
      }
    }
 
    // extra options?
    
    if (!empty($options)) {
      curl_setopt_array($curly[$id], $options);
    }
 
    curl_multi_add_handle($mh, $curly[$id]);
  }
 
  // execute the handles
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
 
 
  // get content and remove handles
  foreach($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
    curl_multi_remove_handle($mh, $c);
  }
 
  // all done
  curl_multi_close($mh);
 
  return $result;
}
 
function show($r)
{


foreach($r as $every=> $data)
{
	$j_arr=json_decode($data,true);
  //var_dump($j_arr);
	for($i=0;$i<1;$i++)
	{
    ?>

       <div class="inners container">
      <div class="row">
        <div class="col-md-offset-3 col-md-6">
         <a href="<?php echo $j_arr['posts'][$i]['discussion_url']; ?>" target="_blank" class="big-a">
      <div class="panel panel-default" style="background-color: white;"> 
        <div class="panel-body">
          <span class=""><?php echo date('D, d M Y',strtotime($j_arr['posts'][$i]['day'])); ?></span>
         <div class="pull-left" style="margin-right:25px;"><img src="<?php echo $j_arr['posts'][$i]['thumbnail']['image_url']; ?>" height="100" width="100"/>
         </div><br><span class="heading"><?php echo $j_arr['posts'][$i]['name']; ?></span> <br>
          <small class="sub"><?php echo $j_arr['posts'][$i]['tagline']; ?></small> 
          <br><br>
          

           <span onclick="window.open('<?php echo $j_arr['posts'][$i]['redirect_url']; ?>');"><img src="redirect.svg" width="35" height="15px" class=""/></span> &nbsp;&nbsp;&nbsp;
          <?php echo $j_arr['posts'][$i]['votes_count']; ?> Votes
        </div> 
      </div>
    </a>
    </div>
  </div>
</div>

    <?php
		/* echo $j_arr['posts'][$i]['name'].'<br>';
		echo $j_arr['posts'][$i]['tagline'].'<br>';
		echo $j_arr['posts'][$i]['day'].'<br>';
		echo $j_arr['posts'][$i]['thumbnail']['image_url'].'<br>';
		echo $j_arr['posts'][$i]['discussion_url'].'<br>';
         echo $j_arr['posts'][$i]['redirect_url'].'<br>';
		echo '<br>-----<br>';
    */

	}

}


}
if($_REQUEST['period'])
{
	$values=array();
	$periods=$_REQUEST['period'];
	$period=date("m",strtotime($periods));
	$period2=explode(",",$periods);
	$period2=$period2[1];
    $list=array();
    $month = $period;
    $year = $period2;

    for($d=1; $d<=31; $d++)
    {
        $time=mktime(12, 0, 0, $month, $d, $year);          
        if (date('m', $time)==$month)  
         {     
           if(strtotime(date('Y-m-d'))>=strtotime(date('Y-m-d',$time)))
            $list[]=date('Y-m-d', $time);
          }
    }
    
  
		
		$data=array();
		foreach($list as $v)
		{
			$data[]="https://api.producthunt.com/v1/posts?day=".$v;
		}
    $r = multiRequest($data);
          show($r);
    //var_dump($data);
			/*$data = array(
	  'https://api.producthunt.com/v1/posts?days_ago=1',
	  'https://api.producthunt.com/v1/posts?days_ago=2',
	  'https://api.producthunt.com/v1/posts?days_ago=3',
	  'https://api.producthunt.com/v1/posts?days_ago=4',
	  'https://api.producthunt.com/v1/posts?days_ago=5',
	  'https://api.producthunt.com/v1/posts?days_ago=6',
	  'https://api.producthunt.com/v1/posts?days_ago=7',
	);
     */
/*
	$ait = new ArrayIterator($data);
	$cit = new CachingIterator($ait);
	$inc=0;
	$this_data=array();
	foreach($cit as $value)
	{
		$inc++;
    unset($this_data);
        if ($cit->hasNext() ) {
        	$this_data[]=$value;
        	$r = multiRequest($this_data);
          show($r);
        }
	}
	*/

	
	

}
 

 
//echo '<pre>';
//echo $r[0]['posts']['name'];
//echo '<br><br>';
//var_dump(json_decode($r[0]));
//$j_arr=json_decode($r[0],true);
//echo $j_arr['posts'][0]['name'];





 

?>

<script>
/*
var numb_two=Number("<?php echo $numb; ?>");
var period_two="<?php echo $period; ?>";
$('#last-value').val((Number(numb_two+1)));
$('#last-period').val(period_two);
*/
</script>


<?php

?>
<!-- </html> -->


