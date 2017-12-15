<style type="text/css">

    /* located in demo.css and creates a little calendar icon
     * instead of a text link for "Choose date"
     */
    a.dp-choose-date {
        float: left;
        width: 16px;
        height: 16px;
        padding: 0;
        margin: 5px 3px 0;
        display: block;
        text-indent: -2000px;
        overflow: hidden;
        background: url(../img/calendar.png) no-repeat; 
    }
    a.dp-choose-date.dp-disabled {
        background-position: 0 -20px;
        cursor: default;
    }
    /* makes the input field shorter once the date picker code
     * has run (to allow space for the calendar icon
     */
    input.dp-applied {
        width: 140px;
        float: left;
    }
    table.sample {
        border-width: 0px;
        border-spacing: 0px;
        border-style: solid;
        border-color: #d5d3d3;
        border-collapse: collapse;
        background-color: white;
        -webkit-box-shadow: 0px 1px 2px rgba(200, 200, 200, 0.66);
        -moz-box-shadow:    0px 1px 2px rgba(200, 200, 200, 0.66);
        box-shadow:         0px 1px 2px rgba(200, 200, 200, 0.66);
        font:Arial, Helvetica, sans-serif;
        color:#323232;
        font-weight:normal;
        font-size:11px; 	
    }
    table.sample th {
        border-width: 1px;
        padding: 10px;
        border-style: inset;
        border-color: #d5d3d3;
        background-color: FFFFFF;
        -moz-border-radius:0 ;
        background-image: linear-gradient(bottom, rgb(242,242,242) 50%, rgb(252,252,252) 100%);
        background-image: -o-linear-gradient(bottom, rgb(242,242,242) 50%, rgb(252,252,252) 100%);
        background-image: -moz-linear-gradient(bottom, rgb(242,242,242) 50%, rgb(252,252,252) 100%);
        background-image: -webkit-linear-gradient(bottom, rgb(242,242,242) 50%, rgb(252,252,252) 100%);
        background-image: -ms-linear-gradient(bottom, rgb(242,242,242) 50%, rgb(252,252,252) 100%);
    }

    table.sample tr:hover {
        background-color:#eee;
    }

    table.sample td {
        border-width: 1px;
        padding: 0;
        border-style: inset;
        border-color: #d5d3d3;
        background-color: white;
        -moz-border-radius:0;
        font-weight:600;
    }

    .tableheadertxt{
        width:30%;
        float:left;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#c5d52b;
        padding-left:15px;
        padding-top:15px;
        text-align:left;
    }


    .tablesearchblock{
        width:20%;
        float:right;
        padding-right:15px;
        padding-top:6px;
        text-align:right;	
    }

    .timetext{
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#333;
        font-weight:bold;
    }

    .appoblock{
        background-color:#900;
        font-family:Arial, Helvetica, sans-serif;
        font-size:11px;
        color:#FFF;
        padding:4px;
        border-bottom:1px solid #FFF;	
    }

    /* popup style start*/

    a,a:active,a:visited {
        color: #09c;
    }

    a:hover {
        color: #0cf;
    }

    h1 {
        font-size: 3em;
        color: #FFCC00;
    }


    .footer {
        background-color: #000;
        padding: 0.5em;
    }

    .leightbox {
        color: #333;
        display: none;
        position: absolute;
        top: 25%;
        left: 25%;
        width: 500px;
        height: 470px;
        padding: 1em;
        border: 1em solid #B8B8B8;
        background-color: white;
        text-align: left;
        z-index:1001;
        overflow: auto;	
    }

    #overlay{
        display:none;
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        z-index:1000;
        background-color:#333;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }

    .lightbox[id]{ /* IE6 and below Can't See This */    position:fixed;    }#overlay[id]{ /* IE6 and below Can't See This */    position:fixed;    }

    .inputformpop{
        width:230px;
        height:24px;
        border:1px solid #CCC;
        border-radius:4px;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        -o-border-radius:4px;
        -khtml-border-radius:4px;
        background-position:left;
        margin:5px;
        font-family:Arial, Helvetica, sans-serif;
        color:#000;
        font-size:11px;
    }
    .inputformsmall{
        width:100px;

    }


    .inputtxtpop{
        width:300px;
        height:150px;
        border:1px solid #CCC;
        border-radius:4px;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        -o-border-radius:4px;
        -khtml-border-radius:4px;
        background-position:left;
        margin:5px;
        font-family:Arial, Helvetica, sans-serif;
        color:#000;
        font-size:11px;
    }
    .ui-tooltip, .arrow:after {
        background: black;
        border: 2px solid white;
    }
    .ui-tooltip {
        padding: 10px 20px;
        color: white;
        border-radius: 20px;
        font: bold 14px "Helvetica Neue", Sans-Serif;
        text-transform: uppercase;
        box-shadow: 0 0 7px black;
    }
    .arrow {
        width: 70px;
        height: 16px;
        overflow: hidden;
        position: absolute;
        left: 50%;
        margin-left: -35px;
        bottom: -16px;
    }
    .arrow.top {
        top: -16px;
        bottom: auto;
    }
    .arrow.left {
        left: 20%;
    }
    .arrow:after {
        content: "";
        position: absolute;
        left: 20px;
        top: -20px;
        width: 25px;
        height: 25px;
        box-shadow: 6px 5px 9px -9px black;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        tranform: rotate(45deg);
    }
    .arrow.top:after {
        bottom: -20px;
        top: auto;
    }
    
.updateBox {
    background: linear-gradient(to bottom, #ACDE57 0%, #96C742 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #507E0C;
    border-radius: 3px;
    color: #FFFFFF;
    float: left;
    font: 12px/26px Arial,Helvetica,sans-serif;
    height: 26px;
    margin: 0 10px 0 0;
    padding: 0 10px;
    text-decoration: none;
    width: auto;
}
.datetime select:nth-child(3){clear:both;}

    /* popup style start*/

</style>
<div style="float:left;">
<?php //pr($this->data);
echo $this->Html->link('Edit', '/events/edit/' . $this->data['Event']['id'], array('class' => 'blue_btm fancybox fancybox.iframe'));
?>
</div>
<div style="float: right;">
<?php
if($flag == '1')
echo $this->Html->link('Complete Event', '/events/edit/' . $this->data['Event']['id'], array('class' => 'blue_btm fancybox fancybox.iframe'));
if($flag == '2')
echo $this->Html->link('Submit Expense', '/reimbursements/add/' . $this->data['Event']['id'], array('class' => 'blue_btm fancybox fancybox.iframe'));
?>
</div>


<div id="inline" class="inline">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <td align="left" valign="middle"><h1>View Event</h1></td>
            <td align="right" valign="middle">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
            <td width="20%" align="right" valign="middle">Start Date</td>
            <td width="1%" align="center" valign="middle">:</td>
            <td width="79%" align="left" valign="middle">
               
                <?php
				echo $this->data['Event']['start_date'];
              
                ?>
               
            </td>
        </tr>
        <tr>
            <td width="20%" align="right" valign="middle">End Date</td>
            <td width="1%" align="center" valign="middle">:</td>
            <td width="79%" align="left" valign="middle">
                <?php
				echo $this->data['Event']['end_date'];

                ?>
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle">Activity Level</td>
            <td align="center" valign="middle">:</td>
            <td align="left" valign="middle"><?php
					
					if($this->data['Event']['activity_level'] == 1)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];
						
					if($this->data['Event']['activity_level'] == 2)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['Builder']['builder_name'];	
						
					if($this->data['Event']['activity_level'] == 3)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['Project']['project_name'];	
						
					if($this->data['Event']['activity_level'] == 4)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['City']['city_name'];
					
					if($this->data['Event']['activity_level'] == 5)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['Suburb']['suburb_name'];
						
					if($this->data['Event']['activity_level'] == 6)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['Area']['area_name'];
						
					if($this->data['Event']['activity_level'] == 7)
						echo  $this->data['ActivityLevel']['value'].'-'.$this->data['Event']['event_level_desc'];				                
                    ?>
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle">Activity Type</td>
            <td align="center" valign="middle">:</td>
            <td align="left" valign="middle">
<?php 
			if($this->data['Event']['activity_type'] == 1)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['User']['lname'];	
			
			if($this->data['Event']['activity_type'] == 2)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['User']['lname'];	
				
			if($this->data['Event']['activity_type'] == 3)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['User']['lname'];	
				
			if($this->data['Event']['activity_type'] == 4)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['Channel']['channel_name'];		
				
			if($this->data['Event']['activity_type'] == 5)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['Channel']['channel_name'];		
				
			if($this->data['Event']['activity_type'] == 6)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['Channel']['channel_name'];		
				
			if($this->data['Event']['activity_type'] == 7)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['Channel']['channel_name'];		
				
			if($this->data['Event']['activity_type'] == 8)
				echo  $this->data['ActivityType']['value'].'-'.$this->data['User']['fname'].' '.$this->data['Channel']['channel_name'];	
			
			if($this->data['Event']['activity_type'] == 9)
				echo  $this->data['ActivityType']['value'].'-From: '.$this->data['FromCity']['city_name'].' To: '.$this->data['ToCity']['city_name'];
				
			if($this->data['Event']['activity_type'] == 10)
				echo  $this->data['ActivityType']['value'].' - '.$this->data['Event']['event_type_desc'];						
?>
            </td>
        </tr>

    </table>
</div>
