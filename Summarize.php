<!DOCTYPE html>
<?php
    $this_dir = dirname(__FILE__);
    $audio_dir = 'audio/';
    $upload_dir = 'uploads/';
    $sum_dir = 'summary/';
    $tmp_name = $_FILES["uploadFile1"]["tmp_name"];
    $name = $_FILES["uploadFile1"]["name"];
    $target_file = $upload_dir . basename($_FILES["uploadFile1"]["name"]);
    $moved = move_uploaded_file($tmp_name, "$upload_dir/$name");
    $fileType = pathinfo($name,PATHINFO_EXTENSION);
    $fileName = pathinfo($name, PATHINFO_FILENAME);

    if($fileType != "txt" && $fileType != "doc" ){
        echo "Sorry only TXT  files are allowed.";
        $uploadOk = 0;
    }
    else {
        $python = `python summarize.py $target_file $fileName`;
        $audio = `python TTS.py $fileName`;
        #echo $audio;
    }
    
    $locText = $sum_dir.$python;
    $locAudio = $audio_dir.$audio;
    
    $target_spath = $this_dir . '/summary/' . $fileName . '.txt';
    $myfileS = fopen($target_spath, "r")or die("Unable to open file!");
    $summary = fread($myfileS,filesize($target_spath));
    fclose($myfileS);
    
    $target_tpath = $this_dir . '/uploads/' . $fileName . '.txt';
    $myfileT = fopen($target_tpath, "r")or die("Unable to open file!");
    $Text = fread($myfileT,filesize($target_tpath));
    fclose($myfileT);
    
    
    ?>
    <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>kurzBot</title>

    

 
    
    
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="themes/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/custom/css/flexslider.css" type="text/css" media="screen">    	
    <link rel="stylesheet" href="assets/custom/css/parallax-slider.css" type="text/css">
    <link rel="stylesheet" href="assets/font-awesome-4.0.3/css/font-awesome.min.css" type="text/css">

    <!-- Custom styles for this template -->
	
    <link href="assets/custom/css/business-plate.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/custom/ico/favicon.ico">
    
    <!-- CSS for file input-->
    <style type="text/css">
        input[type="file"]{
            
      display : none;
            
        }
        
        textarea {
   border-style: none; 
   background-color : #e0e0e0;
    overflow: auto;
    width: 100%;
height: 490px;
 overflow: auto;
 font-size: x-large;
   
}
    </style>
  </head>
<!-- NAVBAR
================================================== -->
  <body>
	<div class="top">
    <div class="container">
        <div class="row-fluid">
            <ul class="phone-mail">
                <li><i class="fa fa-phone"></i><span>9158900262</span></li>
                <li><i class="fa fa-envelope"></i><span>ashu.au43@gmail.com</span></li>
            </ul>
      
        </div>
    </div>
	</div>
	
    <!-- topHeaderSection -->	
    <div class="topHeaderSection">		
    <div class="header">			
		<div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.html"></a>
        </div
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Home</a></li>
           
            <li><a href="#advantage" >Advantages  </a><br></li>
            
            
            <li><a href="#application">Applications </a></li>
              <li><a href="#implementation">Implementation </a></li>
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	</div>
	</div>

    <!-- bannerSection -->
    <div class="bannerSection">
        <div class="slider-inner">
			<div id="da-slider" class="da-slider">
				<div class="da-slide">
					<h2><i>KurzBot</i> <br> <i>The smart Summarizer  </i> <br> <i></i></h2>
					
					<div class="da-img"><img src="assets/custom/img/Responsive-Website-Design-Devices_1.png" alt="" /></div>
				</div>
				
				<div class="da-slide">
					<h2><i>Conversion of  </i> <br> <i> long article to short </i> <br> <i>in few seconds ... </i></h2>
					
                                        <div class="da-img"><a href="#implementation"><img src="assets/custom/img/4_1.png" alt="" /></a></div>
				</div>
				
				
				
				
				<nav class="da-arrows">
					<span class="da-arrows-prev"></span>
					<span class="da-arrows-next"></span>		
				</nav>
			</div><!--/da-slider-->
		</div><!--/slider-->
		<!--=== End Slider ===-->


	</div>
    <!-- highlightSection -->
    <div class="highlightSection">
		<div class="container">
			<div class="row">
			<div class="col-md-8">
                            <h2>The Smart Summarizer ... </h2><br>
			 <em> KurzBot- The smart Summarizer is an system which 
			which takes user input in both ways TEXT and VOICE  later the smart summarizer summaries the document and  returns in user requested format  
                         </em></p>
			</div>
			
			</div>
		</div>
	</div>
	<div class="footerTopSection" id="implementation">
        <h3>  &nbsp; &nbsp; &nbsp; Summarization  <br><br>
        
            &nbsp; </h3>
        
        <div class="container">
            <div class="row">
                
                   
                    
                    <CENTER>
                        
                        <form action="Summarize.php" method="POST" enctype="multipart/form-data">
                        <label for="uploadFile1">
                            <h2>Click here to upload the document to Summarize </h2>
                        </label>
                        <input id="uploadFile1" name="uploadFile1" type="file"  accept="" onchange="form.submit()">
                        </form>
                    
                    
                    </CENTER>
                   
            </div>
           
        </div>
    </div>

<div class="container">  
    <div class="row">
        
        
            <div class="form-group">
                <h3><label for="originalText">Original Text:</label></h3>
                <textarea class="form-control" rows="20" id="original"><?php echo $Text; ?></textarea>
            </div>
        
        
        
            <div class="form-group">
                <h3><label for="summary">Summary:</label></h3>
                <textarea class="form-control" rows="20" id="summary"><?php echo $summary; ?></textarea>
            </div>
        
			<div class="col-lg-3"></DIV>
            <div class="col-lg-3">
                <?php
                    echo '<a href="' . $locAudio . '" download><button type="button" class="btn btn-default btn-lg btn-block" >Download as .mp3</button></a>';
                ?>
            </div>
        
        
            <div class="col-lg-3">
                <?php
                    echo '<a href="' . $locText . '" download><button type="button" class="btn btn-default btn-lg btn-block" >Download as .txt</button></a>';
                ?>
            </div>
	
        
        <br><br><br>
    </div>
    </div>
    
   
	
	
    <!-- bodySection -->
	<!--	<div class="serviceBlock" id="advantage"> 
		<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-compress"></i>
							<div class="desc">
								
								<h4>Automation </h4>
								<p>The manual method which included the person taking the summary out of long article is replaced using our KurzBot the Smart Summarizer  </p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-code"></i>
							<div class="desc">
								
								<h4>Reduced Time consumption</h4>
								<p>The System is well designed for generating output in a faster speed . </p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-thumbs-up"></i>
							<div class="desc">
								
								<h4>Accuracy </h4>
								<p>KurzBot is designed for generating the summary in an accuracy of 90% </p>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-desktop"></i>
							<div class="desc">
								
								<h4>Fully Responsive</h4>
								<p>The System is user friendly where user just need to add the file .   </p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-html5"></i> 
							<div class="desc">
								
								<h4>scoring function  </h4>
								<p>  This scoring function includes only the words with height weights and score , thus generating a summary .  </p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-css3"></i>
							<div class="desc">
								
								<h4>Works Instantly </h4>
								<p>Reading the entire article, dissecting it and separating the important ideas from the raw text takes time and effort.   </p>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="clearfix">
							<i class="fa fa-github"></i>
							<div class="desc">
								
								<h4>Don't miss important facts</h4>
								<p>A unique features that some software have, is the ability to declare a word whose sentences that include it will automatically appear at the summary. 

     </p>
							</div>
						</div>
					</div>
					
					
				</div>
		</div>
		</div>
	<hr>
	
	-->
   

					
	<!--				

        <div class="services" id="application">
			<div class="container"> 
				<div class="row">
					<div class="col-md-3">
                                                                                                                                                                      <img src="assets/custom/img/meeting.jpg" class="" title="project one">				
								<h3><a class="hover-effect" href="#">Generate Minutes of Meeting </a></h3>
							<p>The Advanced version of system can be used to generate the mintes of meeting for an office review meeting or any other . .</p>
					 </div>
					<div class="col-md-3">
								<img src="assets/custom/img/teacher.png" class="" title="project one">
											
								<h3><a class="hover-effect" href="#">A Summarized Lecture </a></h3>
							<p>The lecture delivered by the professor can be recorded using KurBot and a small summary of what topics were covered can be formed </p>
					 </div>
					<div class="col-md-3">
								<img src="assets/custom/img/doc.jpg" class="" title="project one">
								
								<h3><a class="hover-effect" href="#">In the field of Medical</a></h3>
							<p>In The field of medical the doctors need not to check the reports of many years but can view the summarized report generated by system .</p>
					 </div>
					<div class="col-md-3">
								<img src="assets/custom/img/main.jpg" class="" title="project one">
									
								<h3><a class="hover-effect" href="#"> Relevent data from Article </a></h3>
							<p>We come across a lots of article but to understand it we need to read it completely. The system focus on relevent and Important data . .</p>
					 </div>
				 </div>	
			</div>
		</div>

		
		<div class="testimonails">
		<div class="container">
		<blockquote class="">
                    <p><h2> So basically  how does it works  ?</h2>   The system uses an scoring mechanism which generate the score of each word with respect to it importance and occurence . The sentence with highest sentence score is more likely to appear in summary . This generated summary is then displayed .    </p>
                <small>- The Smart Summarizer</small>
            </blockquote>		
		</div>
		</div>
		
		
	</div>
	</div> -->
    <!-- clientSection -->
	
	
	
    <!-- footerTopSection -->
    
    
    

        
            


    <!-- footerBottomSection -->	
	<div class="footerBottomSection">
		<div class="container">
                    <h3 align="right">KurzBot - The  Smart Summarizer </h3>
			
		</div>
	</div>
	
<!-- JS Global Compulsory -->			
<script type="text/javascript" src="assets/custom/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="assets/custom/js/modernizr.custom.js"></script>		
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>	
	
	<!-- JS Implementing Plugins -->           
<script type="text/javascript" src="assets/custom/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="assets/custom/js/modernizr.js"></script>
<script type="text/javascript" src="assets/custom/js/jquery.cslider.js"></script> 
<script type="text/javascript" src="assets/custom/js/back-to-top.js"></script>
<script type="text/javascript" src="assets/custom/js/jquery.sticky.js"></script>

<!-- JS Page Level -->           
<script type="text/javascript" src="assets/custom/js/app.js"></script>
<script type="text/javascript" src="assets/custom/js/index.js"></script>


<script type="text/javascript">
    
    
function loadFileAsText()
{
    var fileToLoad = document.getElementById("fileToLoad").files[0];
 
    var fileReader = new FileReader();
    fileReader.onload = function(fileLoadedEvent) 
    {
        var textFromFileLoaded = fileLoadedEvent.target.result;
        document.getElementById("inputTextToSave").value = textFromFileLoaded;
    };
    fileReader.readAsText(fileToLoad, "UTF-8");
}


    jQuery(document).ready(function() {
      	App.init();
        App.initSliders();
        Index.initParallaxSlider();
    });
    
  
</script>


	</body>
</html>