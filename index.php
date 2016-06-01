<html>
<head>
     <title>
    PH - Best of every month
  </title>
  <meta charset="utf-8">
  <meta name="description" content="The most upvoted products in product hunt, each day in every month" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  
  <script type="text/javascript" src="datepicker/zebra_datepicker.js"></script>
  <link rel="shortcut icon" href="ph.png">
   
<link rel="stylesheet" href="datepicker/default.css" type="text/css">
  <style>
  body
  {
    background-color: #d3d3d3;
    font-family: 'Roboto', sans-serif;
  }
  .heading
  {
    font-size: 20px;
    font-weight: 200;
    

  }
  .sub
  {
    font-size: 14px;
    font-weight: 200;
    color: #999;
  }
  .big-a:hover, .big-a:link
  {
    color:black;
    text-decoration: none;
  }
  .big-a
  {
    color: black;
    text-decoration: none;
  }
  .name
  {
    color:#da552f;
    font-size: 24px;
  }
  .tag
  {
    font-size: 16px;
  }

  input[type='text']
{
width: 200px;
height: 29px;
border-radius: 3px;
border: 0px solid #CCC;
border-bottom: 1px solid black;
padding: 8px;
font-weight: 200;
font-size: 15px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;
background-color: transparent;
color:#da552f;
}

input[type='text']:hover
{
width: 200px;
height: 29px;
border-radius: 3px;
border: 0px solid #aaa;
border-bottom: 1px solid black;
padding: 8px;
font-weight: 200;
font-size: 15px;
font-family: Verdana;
box-shadow: 1px 1px 5px #CCC;
background-color: transparent;
color:#da552f;
}

::-webkit-input-placeholder { 
    color:#da552f;
}
  </style>
  
</head>
<body>

<?php
for ($i = 1; $i <= 12; $i++) {
    $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
}

?>
<br>
<center>
<img src="ph.png" height="60" width="60"/> &nbsp;&nbsp;<span class="name">Best of every month</span><br><br>
<p class="tag">The most upvoted products, each day in every month
</p>
</center>
<br>

<center>
 <input type="text" name="" placeholder="Pick a Month" value="" id="period" class="datetimepicke">
<br><br>
</center>

<div id="get-post">

</div>
<!-- <button id="show-more" type="button" style="display:none">Show More</button> -->
<center><div id="loading" style="display:none;font-size:20px">
Hunting down posts...
</div>
</center>
</body>



<script>
$('#period').Zebra_DatePicker({
  format: 'M, Y'   ,
  onSelect : function(date1,date2,date3,date4){
    console.log("changed");
    $('#loading').css('display','');
    $('#get-post').css('display','none');
    var period=$('#period').val();
    var number=1;
    console.log(period);
     $.ajax({
            type:'POST',
            url:'ph-test.php',
            data:'period='+period+'&number='+number,
            success:function(html){
               // $('#show_more_main'+ID).remove();
                $('#get-post').html(html);
                $('#get-post').css('display','');
                $('#loading').css('display','none');
                
            }
        }); 
  }
                  
});
 </script> 
 <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-76699213-1', 'auto');
  ga('send', 'pageview');


 </script>
</html>