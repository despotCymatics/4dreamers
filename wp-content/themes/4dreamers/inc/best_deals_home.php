<?php 
//best deals homepage
require_once 'model.php';

$rs = get_best_deals();
$city_name_list = array();

if (count($rs) > 1) {
$lang = get_bloginfo('language');
?>
<section class="best-deals" style=""> 
	<div class="container">
    	<div class="row">
        	<h2 class="section-title"><?php echo pll__('Best Deals'); ?></h2>
        	<ul class="bxslider offers">
          <?php foreach ($rs as $deal) { ?>
              <li>
              <?php 
                $city_name = get_city_name($deal->DTo);
                if(!in_array($city_name, $city_name_list)):
                      array_push($city_name_list, $city_name);
                      $dateInfo = date_parse_from_format('Y-m-d', $deal->DepartureDate);
                      $DepartureDate = strtotime($dateInfo['month']."/".$dateInfo['day']."/".$dateInfo['year']);
                      $DepartureDate2 = date("d/m", $DepartureDate);
                      $DepartureDate = date("d/m/Y", $DepartureDate);

                      $dateInfo = date_parse_from_format('Y-m-d', $deal->ReturnDate);
                      $ReturnDate = strtotime($dateInfo['month']."/".$dateInfo['day']."/".$dateInfo['year']);
                      $ReturnDate2 = date("d/m", $ReturnDate);
                      $ReturnDate = date("d/m/Y", $ReturnDate);

                      if($lang == "sr-RS") {  
                            $link = "/sr/rezultati-pretrage/?params=FlightType=".$deal->FlightType."&From=".$deal->DFrom."&To=".$deal->DTo."&DepartureDate=".$DepartureDate."&ReturnDate=".$ReturnDate."&QFrom=".$deal->QFrom."&QTo=".$deal->QTo."&AdtCount=1&ChdCount=0&InfCount=0&CabinClass=Y&DepartureTime=00:01&ReturnTime=00:01&IsCalendarSearch=false&Culture=sr-Latn-CS&Method=".$deal->Method."&Page=".$deal->Page;
                          }else {
                            $link = "/en/result-page/?params=FlightType=".$deal->FlightType."&From=".$deal->DFrom."&To=".$deal->DTo."&DepartureDate=".$DepartureDate."&ReturnDate=".$ReturnDate."&QFrom=".$deal->QFrom."&QTo=".$deal->QTo."&AdtCount=1&ChdCount=0&InfCount=0&CabinClass=Y&DepartureTime=00:01&ReturnTime=00:01&IsCalendarSearch=false&Culture=en-GB&Method=".$deal->Method."&Page=".$deal->Page;
                          }
                    ?>
                    	<a target="_self" href="<?php echo $link; ?>">
                    		<p class="destination"><i class="fa fa-plane" style="margin-right:5px;"></i><?php echo $city_name; ?></p>
                        <?php if($lang == "sr-RS") {
                          
                            if(substr($deal->Price, -3, 3) == ".00" || substr($deal->Price, -3, 3) == ",00") {
                                $srPrice = substr($deal->Price, 0, -3);
	                            //$srPrice = $deal->Price;
                            }else {
                              $srPrice = $deal->Price;
                            }
                        ?>
                          <p class="price"><?php echo $srPrice." ".$deal->Curr; ?></p>
                        <?php } else { ?> 
                          <p class="price"><?php echo $deal->Price2."&euro;"; ?></p>
                        <?php } ?>
                          <p class="date"><?php echo  $DepartureDate2; ?> - <?php echo  $ReturnDate2; ?></p>
                      </a>
                    </li>
                <?php endif; ?>
          <?php } ?>    
            </ul>
        </div>
    </div>
</section>
<script type="text/javascript">
   $('.bxslider.offers').bxSlider({
    minSlides: 3,
    maxSlides: 5,
    slideWidth: 223,
    slideMargin: 5,
    controls: false,
    pager: ($(".bxslider li").length > 5) ? true: false
  });
</script>

<?php } ?>
