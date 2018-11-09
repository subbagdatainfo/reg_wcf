<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GpdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
	#left
	{
	  width: 50%;
	  border: 1px solid;
	  min-height: 150px;
	  float: left;
	}

	#right
	{
	  margin-left: 50%;
	  border: 1px solid;
	  min-height: 150px; /* Change this to whatever the width of your left column is*/
	}

	.clear
	{
	  clear: both;
	}
</style>

<div class="dashboard-index jumbotron2" style="background:#fff; border:1px solid #dcdcdc;">
	<!-- <br><h1>Selamat datang</h1>  -->
	<!-- <h1>Welcome to World Culture Forum Registration System.</h1> -->
	<center>
		<!-- <div style="margin-bottom:-10px;"><img width="70px" src="/web/images/logo-wcf.png"> </div> -->

		<b style="margin-top:20px; font-size:24px;">
			<span style="font-size:14px;">WORLD CULTURE FORUM 2016 </span><br>
			General Information
		</b>
	</center>
	<div style="width:100%; height:2px; background:#eee; margin-top:10px; margin-bottom:10px;"></div>

	<div class="dsb-konten">
		<span class="dsb-jdl">1. Background</span>
		<br>
		<span class="col-md-12 dsb-isi">
			Following the inaugural World Culture Forum (WCF) in 2013, Indonesia will hold the 2nd World Culture Forum in 2016. The forum will be conducted from 10 – 14 October 2016 in Nusa Dua, Bali, Indonesia. The forum is the continuation of an ongoing effort to emphasize the importance of culture as a driver and enabler of sustainable development. 
		</span>
	</div>

	<div class="dsb-konten">
		<span class="dsb-jdl">2. Program</span>
		<br>
		<span class="col-md-12 dsb-isi">
			Monday, 10 October 2016		 <span style="margin-left:40px;"> : Arrivals, Subak Visit, Cultural Visit and Welcome Dinner<br>
			Tuesday, 11 October 2016		<span style="margin-left:37px;">: Symposiums and Cultural Carnival<br>
			Wednesday, 12 October 2016		<span style="margin-left:17px;">: Symposiums and Gala Dinner<br>
			Thursday, 13 October 2016		<span style="margin-left:32px;">: Grand Plenary, Parallel Meetings, Closing Ceremony	<br>
			Friday, 14 October 2016		<span style="margin-left:50px;"></span>	 : Departures
 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">3. Venue</span>
		<br>
		<span class="col-md-12 dsb-isi"> 
			Bali Nusa Dua Convention Center (BNDCC)<br>
			Nusa Dua Area Blok NW/1, Bali 80363, Indonesia <br>
			Phone 	<span style="margin-left:17px;">: +62-361-773000 <br>
			Website 	<span style="margin-left:6px;">: baliconventioncenter.com
 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">4. Participants</span>
		<br>
		<span class="col-md-12 dsb-isi">
			World Culture Forum 2016 invites Heads of State, Ministers of Culture, Nobel Laureates, cultural experts, scholars, senior policymakers, NGOs, Youths, cultural practitioners and other stakeholders to participate in this global gathering. 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">5. Financial Arrangements</span>
		<br>
		<span class="col-md-12 dsb-isi">
			The Government of Indonesia as the host of the forum will be responsible for the arrangement and payment of accommodation, hospitality expenses (including meals and local transportation) of all invited participants and selected public participants. Please inform the organizing committee regarding any dietary requirement or medical need. 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">6. Visa</span>
		<br>
		<span class="col-md-12 dsb-isi">
			Participants are advised to contact the Indonesian Embassy in their respective countries for entry visa arrangement. No visa is required for citizens of ASEAN member states. Participants are reminded to ensure that their passport validity is no less than six months from the date of expiry. For safety purposes, please make a copy of the passport and bring it together with the original. 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">7. Time</span>
		<br>
		<span class="col-md-12 dsb-isi">
			The time in Bali is GMT+8 or the same as local time in Beijing, Hong Kong, Singapore, and Perth. 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">8. Climate</span>
		<br>
		<span class="col-md-12 dsb-isi">
			The temperature in Bali ranges from 28°-34°C (82.4°-93.2°F). 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">9. Currency</span>
		<br>
		<span class="col-md-12 dsb-isi">
			The Indonesian currency is Rupiah (Rp or IDR). The exchange rate as of July 2016 is 1 USD = 13,170 IDR 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">10. Electricity</span>
		<br>
		<span class="col-md-12 dsb-isi">
			The electricity voltage is 220 V 50Hz. Most electrical sockets are Type A with two blades or European type, round plug with two pins. 
		</span>
	</div>
	<div class="dsb-konten">
		<span class="dsb-jdl">11. Contact Person</span>
		<br>
		<span class="col-md-12 dsb-isi">
			<div id="containedr">
			    <div id="left">
				    <div style=" padding: 10px;">
				      	<strong>Yunia Setyaningrum (Ms.)</strong> 
						<br>Local Affairs (Indonesian Participants). 
						<br>Phone : +62-21- 572-55- 32. 
						<br>Mobile : +6283-2537-6693. 
						<br>Email : <a href="mailto:local.affairs@worldcultureforum-bali.org">local.affairs@worldcultureforum-bali.org</a>
					</div>
			    </div>
			    <div id="right">
			      <div style=" padding: 10px;">
					<strong>Jodi Salahuddin Akbar (Mr.)</strong> 
					<br>International Affairs. 
					<br>Phone : +62-21- 572-55- 32. 
					<br>Mobile : +62812-8650- 7397. 
					<br>Email : <a href="mailto: international.affairs@worldcultureforum-bali.org">international.affairs@worldcultureforum-bali.org</a>
			      </div>
			    </div>
			    <div class="clear"></div>
			</div> 
		</span>
	</div>

	<div class="dsb-konten">
		<span class="dsb-jdl"> &nbsp</span>
		<br>
	</div>



	<!-- #######  YAY, I AM THE SOURCE EDITOR! #########-->
	<!-- <br><span style="text-decoration: underline;">1. Background </span> </br>
	<span style="padding-left: 15px;">Following the inaugural World Culture Forum (WCF) in 2013, Indonesia will hold the 2 nd World Culture <br>
	<span style="padding-left: 15px;">Forum in 2016. The forum will be conducted from 10 &ndash; 14 October 2016 in Nusa Dua, Bali, Indonesia. The  <br>
	<span style="padding-left: 15px;">forum is the continuation of an ongoing effort to emphasize the importance of culture as a driver and <br>
	<span style="padding-left: 15px;">enabler of sustainable development. 
	<br><span style="text-decoration: underline;">2. Program </span> </br>
	<span style="padding-left: 15px;">Monday, 10 October 2016 : Arrivals, Subak Visit, Cultural Visit and Welcome Dinner <br>
	<span style="padding-left: 15px;">Tuesday, 11 October 2016 : Symposiums and Cultural Carnival <br>
	<span style="padding-left: 15px;">Wednesday, 12 October 2016 : Symposiums and Gala Dinner <br>
	<span style="padding-left: 15px;">Thursday, 13 October 2016 : Grand Plenary, Parallel Meetings, Closing Ceremony <br>
	<span style="padding-left: 15px;">Friday, 14 October 2016 : Departures
	<br><span style="text-decoration: underline;">3. Venue </span> </br>
	<span style="padding-left: 15px;">Bali Nusa Dua Convention Center (BNDCC) <br>
	<span style="padding-left: 15px;">Nusa Dua Area Blok NW/1, Bali 80363, Indonesia  <br>
	<span style="padding-left: 15px;">Phone : +62-361- 773000  <br>
	<span style="padding-left: 15px;">Website : baliconventioncenter.com  
	<br><span style="text-decoration: underline;">4. Participants </span> </br>
	<span style="padding-left: 15px;">World Culture Forum 2016 invites Heads of State, Ministers of Culture, Nobel Laureates, cultural experts, <br> 
	<span style="padding-left: 15px;">scholars, senior policymakers, NGOs, Youths, cultural practitioners and other stakeholders to participate <br> 
	<span style="padding-left: 15px;">in this global gathering.
	<br><span style="text-decoration: underline;">5. Financial Arrangements </span> </br>
	<span style="padding-left: 15px;">The Government of Indonesia as the host of the forum will be responsible for the arrangement and  <br>
	<span style="padding-left: 15px;">payment of accommodation, hospitality expenses (including meals and local transportation) of all invited  <br>
	<span style="padding-left: 15px;">participants and selected public participants. Please inform the organizing committee regarding any  <br>
	<span style="padding-left: 15px;">dietary requirement or medical need. 
	<br><span style="text-decoration: underline;">6. Visa </span> </br>
	<span style="padding-left: 15px;">Participants are advised to contact the Indonesian Embassy in their respective countries for entry visa  <br>
	<span style="padding-left: 15px;">arrangement. No visa is required for citizens of ASEAN member states. Participants are reminded to  <br>
	<span style="padding-left: 15px;">ensure that their passport validity is no less than six months from the date of expiry. For safety purposes, <br> 
	<span style="padding-left: 15px;">please make a copy of the passport and bring it together with the original. 
	<br><span style="text-decoration: underline;">7. Time </span> </br>
	<span style="padding-left: 15px;">The time in Bali is GMT+8 or the same as local time in Beijing, Hong Kong, Singapore, and Perth. 
	<br><span style="text-decoration: underline;">8. Climate </span> </br>
	<span style="padding-left: 15px;">The temperature in Bali ranges from 28&deg;-34&deg;C (82.4&deg;-93.2&deg;F). 
	<br><span style="text-decoration: underline;">9. Currency </span> </br>
	<span style="padding-left: 15px;">The Indonesian currency is Rupiah (Rp or IDR). The exchange rate as of July 2016 is 1 USD = 13,170 IDR 
	<br><span style="text-decoration: underline;">10. Electricity </span> </br>
	<span style="padding-left: 15px;">The electricity voltage is 220 V 50Hz. Most electrical sockets are Type A with two blades or European type,<br> 
	<span style="padding-left: 15px;">round plug with two pins. 
	<br><span style="text-decoration: underline;">11. Contact Person </span> 
	<br>
	<div id="container">
	    <div id="left">
		    <div style=" padding: 2px;">
		      	<strong>Yunia Setyaningrum (Ms.)</strong> 
				<br>Local Affairs (Indonesian Participants). 
				<br>Phone : +62-21- 572-55- 32. 
				<br>Mobile : +6285-9286- 4997. 
				<br>Email : local.affairs@worldcultureforum-bali.org 
			</div>
	    </div>
	    <div id="right">
	      <div style=" padding: 2px;">
			<strong>Jodi Salahuddin Akbar (Mr.)</strong> 
			<br>International Affairs. 
			<br>Phone : +62-21- 572-55- 32. 
			<br>Mobile : +62812-8650- 7397. 
			<br>Email : international.affairs@worldcultureforum-bali.org 
	      </div>
	    </div>
	    <div class="clear"></div>
	</div> -->


	<!-- <div style="border:1px solid; width:50%; position:relative">
		
	</div>
	<div style="border:1px solid; width:50%; position:relative">
		<
	</div> -->
</div>
<div style="margin-top:20px;"></div>