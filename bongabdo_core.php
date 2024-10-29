<?php
/*  Copyright 2008-2009  Sajid Muhaimin Choudhury (email : smc@ieee.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


    /* Content must be exactly as "dd-mm-yyyy"
        /**
        * @desc : convert english dates into unicode formatted bangla dates according to Bangladeshi Calender                     
        * @author : Sajid Muhaimin Choudhury
        * @since : February 15, 2009
        * 
        * This program was written back in 2001 in qbasic. The month names were in English
        * Later in 2003 it was ported to visual basic. I didn't know how to use unicode, and
        * used bijoy scripts for it.
        * As I learnt about wp plugin system more, i decided to port it to Wordpress. 
        * Now I have Bangla Unicode, and thus can use it.
        */
        

if (!function_exists('bongabdo')) {
    function bongabdo($inputdate) {
     global $beng_month_name, $bdeng_month_name;
        if ($inputdate=='')  $inputdate=date('d-m-Y');
        
        $corebangladate = bongabdo_core($inputdate);
        $day  = (int)substr($corebangladate , 0, 2);
        $month  = (int)substr($corebangladate , 3, 2);
        $year = (int)substr($corebangladate, 6, 4);
        if(is_beng()) {//if language is bengali
            $bangladate  = $day  . ' ' . $beng_month_name[$month]['bd'] . ' ' . $year;
            $bangladate  = number2bengunicode($bangladate);
        }
        else { //Non bengali lang
            $bangladate  = $day  . ' ' . $beng_month_name[$month]['en'] . ' ' . $year;
        } 
        return $bangladate ; 
  }
}



if (!function_exists('bongabdoeasy')) {
    function bongabdoeasy($day, $month, $year, $retrype, $forcebn) {
    // forcebn = 0, language autodetect, forcebn =1, always return bangla, forcebn = 2, return english
     global $beng_month_name;
        //if ($inputdate=='')  $inputdate=date('d-m-Y');
        $endate = '';
        if ($day < 10) $endate = $endate . '0';
        $endate = $endate . $day . '-';
          
        if ($month < 10) $endate = $endate . '0';
        $endate = $endate . $month  . '-';
        
        $endate = $endate . $year;
        //echo $endate;
        $corebangladate = bongabdo_core($endate);
        //echo $corebangladate ;
        $eday  = (int)substr($corebangladate , 0, 2);
        $emonth  = (int)substr($corebangladate , 3, 2);
        $eyear = (int)substr($corebangladate, 6, 4);
        
        switch ($retrype) {
          case 'm':
          $myret = $emonth;
          break;
          case 'M':
                  if ($forcebn == 2) return $beng_month_name[$emonth]['en'];
                  if ($forcebn == 1) return $beng_month_name[$emonth]['bd'];

                  if(is_beng()) {//if language is bengali
                      return $beng_month_name[$emonth]['bd'];
                  }
                  else { //Non bengali lang
                      return $beng_month_name[$emonth]['en'];
                  } 

          break;
          case 'y':
          $myret = $eyear;
          break;
          case 'd':
          $myret = $eday;
          break;
          }
          
        if ($forcebn == 2) return $myret;
        if ($forcebn == 1) return number2bengunicodenc($myret);

        if(is_beng()) {//if language is bengali
            return number2bengunicode($myret);
        }
        else { //Non bengali lang
            return $myret;
        } 
  }
}


    /* main algorithm */
if (!function_exists('bongabdo_core')) {
    function bongabdo_core($inputdate) {
        
        $day  = (int)substr($inputdate, 0, 2);
        $month  = (int)substr($inputdate, 3, 2);
        $year = (int)substr($inputdate, 6, 4);

        
        // Supplying the magic numbers...
    $EngMonthDay = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $DaysToAdd   = array (17, 18, 17, 17, 17, 17, 16, 16, 16, 15, 16, 16);
    $DaysToSub   = array (13, 12, 14, 13, 14, 14, 15, 15, 15, 15, 14, 14);

    for ($n = 0; $n <6; $n++) {
        $BengMonthDay[$n] = 31;
        $BengMonthDay[$n + 6] = 30;
    }

    //Calculating The Date...
    // Updating leap year
    if (IsLeapYear($year)) {
        $EngMonthDay[1] = 29; //February
        $BengMonthDay[10] = 31; //Falgun
        }
        //echo 'Feb=' . $EngMonthDay[1] . ', Falg=' . $BengMonthDay[10];

    //'Calculating Bengali Year
    $BengYear = $year - 594;
    for ($i = 0; $i < ($month - 1); $i++) {
    //FOR i = 1 TO EngMonth - 1
        $DayYearPassed = $DayYearPassed + $EngMonthDay[$i];
        }


    $DayYearPassed = $DayYearPassed + $day;
    if ($DayYearPassed >= 104) $BengYear = $BengYear + 1; // A new year is hit

    //' Calculating Month
    $BengMonth = $month + 8;
    if ($month > 4) $BengMonth = $month - 4;
    //IF EngMonth > 4 THEN BengMonth = EngMonth - 4

    //'Calculating Date
    $BengDate = $day + $DaysToAdd[$month-1];
    

    if ($BengDate > $BengMonthDay[$BengMonth-1]) {
        $BengMonth = $BengMonth + 1;
        if ($BengMonth > 12) $BengMonth = $BengMonth - 12;
        $BengDate = $day - $DaysToSub[$month-1];
    }
    
    if ($day < 14 &&  $month == 3  && !IsLeapYear($year))  //1st - 15 March of leap year
        $BengDate = $BengDate - 1;

    if ($day == 14 &&  $month == 3  && !IsLeapYear($year)) { //14th March of Non Leap Year, trouble some
        $BengDate = 30;
        $BengMonth = 11;
    }
    
    if ($BengDate < 10) 
         $ret = '0';
    $ret = $ret . $BengDate . '/';
    if ($BengMonth < 10) 
         $ret = $ret . '0';
    $ret = $ret . $BengMonth . '/';
    $ret = $ret . $BengYear;
    return $ret;
     }
    
}

if (!function_exists('IsLeapYear')) {
//This is probably built-in in PHP, but QBasic did not have it
  function IsLeapYear ($yearIn) {
    if ($yearIn % 4 == 0) return true;
    if ($yearIn % 100 == 0) return false;
    if ($yearIn % 4 != 0 ) return false;
  }
}

if (!function_exists('is_beng')) { //is current language bengali?
  function is_beng () {
        /**
      * @desc : Language Detection
      * @author : Sajid Muhaimin Choudhury
      * @since : February 15, 2009
      */
    if ($beng_date_options['use bangla'] == 1)  
    return 1;  //Enable this to output only Bengali Language
    //return 0;  //Enable this to output only English Language
	//if ($beng_date_options['use bangla'] == 1) return 1;
	
    return ((strcmp(substr(get_bloginfo('language'), 0, 2), 'bn'))=='0')  ;
  }
}


if (!function_exists('number2bengunicode')) {
  function number2bengunicode($content)	{
	    /**       
         * @desc : convert english digits to bangla unicode digits
	     * @author : Sajid Muhaimin Choudhury
	     * @since : Feb 2009
	     * modified from function written by Hasin Hayder for his bangla date plugin
	     */
	  if (!is_beng()) return $content;
		$d='';
		$numbers = array(
		48=>"&#2534;",
		49=>"&#2535;",
		50=>"&#2536;",
		51=>"&#2537;",
		52=>"&#2538;",
		53=>"&#2539;",
		54=>"&#2540;",
		55=>"&#2541;",
		56=>"&#2542;",
		57=>"&#2543;",
		);
		for ($i=0; $i<strlen($content); $i++)
		{
			$current = ord(substr($content,$i,1));
			if (array_key_exists($current,$numbers) )
			$unicode = $numbers[$current];
			else
			$unicode = chr($current);
			$d .= $unicode;
		}
		return "".$d."";

	}
}

if (!function_exists('number2bengunicodenc')) {
  function number2bengunicodenc($content)	{
	    /**       
         * @desc : convert english digits to bangla unicode digits
	     * @author : Sajid Muhaimin Choudhury
	     * @since : Feb 2009
	     * modified from function written by Hasin Hayder for his bangla date plugin
	     */
	  //if (!is_beng()) return $content;
		$d='';
		$numbers = array(
		48=>"&#2534;",
		49=>"&#2535;",
		50=>"&#2536;",
		51=>"&#2537;",
		52=>"&#2538;",
		53=>"&#2539;",
		54=>"&#2540;",
		55=>"&#2541;",
		56=>"&#2542;",
		57=>"&#2543;",
		);
		for ($i=0; $i<strlen($content); $i++)
		{
			$current = ord(substr($content,$i,1));
			if (array_key_exists($current,$numbers) )
			$unicode = $numbers[$current];
			else
			$unicode = chr($current);
			$d .= $unicode;
		}
		return "".$d."";

	}
}

/*
//$rx = array(date('d-m-Y'), "11-03-2008", "11-03-2009", "27-02-2008", "27-02-2009", "01-03-2008", "01-03-2009", "29-02-2008",  "11-04-2008", "11-04-2009", "27-04-2008", "27-04-2009", "01-05-2008", "01-05-2009", "29-06-2008","29-06-2009");

$rx = array("01-03-2008", "01-03-2009", "02-03-2008", "02-03-2009", "03-03-2008", "03-03-2009", "04-03-2008", "04-03-2009", "05-03-2008", "05-03-2009",
"06-03-2008", "06-03-2009", "07-03-2008", "07-03-2009", "08-03-2008", "08-03-2009", "09-03-2008", "09-03-2009", "10-03-2008", "10-03-2009", "11-03-2008", "11-03-2009", "12-03-2008", "12-03-2009", "13-03-2008", "13-03-2009", "14-03-2008", "14-03-2009", "15-03-2008", "15-03-2009", "16-03-2008", "16-03-2009");
//debug script. Enable this and execute directly the bongabdo.php
?> 


<title>test</title>
<body>
<h1> Bongabdo test </h1>
<?php for ($i = 0; $i<sizeof($rx); $i++) { 
if ($i %2 == 0) echo '<font color = "#000000">';
else echo '<font color = "#ff1f1f">';
?>
<h2>English Date = <?php echo $rx[$i]; ?>; Bangla Date = <?php echo bongabdo($rx[$i] ); ?></font></h2>
<?php } ?>
</body>

<?php */ ?>