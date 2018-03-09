<?php

/**
 * "Trombinoscope" (in French) of Professors
 */

namespace EPFL\STI\Theme\Widgets;

if (! class_exists('WP_Widget')) {
  die('Access denied.');
}

require_once(dirname(dirname(__FILE__)) . "/inc/i18n.php");
use function \EPFL\STI\Theme\___;
use function \EPFL\STI\Theme\__x;

class FacultyGallery extends \WP_Widget
{
  public function __construct()
  {
    parent::__construct(
      'EPFL_STI_Theme_Widget_FacultyGallery', // unique id
      ___('EPFL Faculty Gallery'), // widget title
      // additional parameters
      array(
        'description' => ___('Shows mugshots of faculty members')
      )
    );
  }

  public function widget ($args, $config)
  {
    $institute = $config["institute"];
    if ($institute) {
      $div_id = "faculty-gallery-$institute";
    } else {
      $div_id = "faculty-gallery";
    }

    ?>
    <directory class="container">
<script type="text/javascript">
var PO=0;
var PA=0;
var PATT=0;
var PT=0;
var MER=0;
var IBI2=0;
var IEL=0;
var IGM=0;
var IMT=0;
var IMX=0;

function findString(tstring,text) {
    // Replaces text with by in string
    var strLength = tstring.length, txtLength = text.length;
    if ((strLength == 0) || (txtLength == 0)){
        return false;
    }
    var i = tstring.indexOf(text);
    if (i == -1) {
        return false;
    }
    else{
        return true;
    }
}

function _doPrintOuter(people_listing, lang) {
  var img_dir="https://stisrv13.epfl.ch/profs/img/";
  var test="";

  var count=0;
  var result=0;
  for(var x=0; x < people_listing.length; x++) {
   if (people_listing[x]) {

    //(findString(people_listing[x].title,'PATT')

	result++;
	test+="<div class='col-8 col-lg-2'> <div class='card-deck'> <div class='box_id card faculty-titre-card'> ";
	test+=people_listing[x].link + "<img class='faculty-img' src='";
	test+=img_dir+people_listing[x].image + "' title='" + people_listing[x].firstname + " " + people_listing[x].lastname;
	test+="'/></a>\n\ <div class='faculty-rouge'></div><div class='faculty-titre-id'><h4>\n" + people_listing[x].link + people_listing[x].lastname + " " +  people_listing[x].firstname + "</h4>";
	test+="</a> \n\ ";
	test+="<a href=" + people_listing[x].labwebsite + "><div class='faculty-lab'>" + people_listing[x].mylabname + "</div></a></div></div></div></div>";
        count++;

   }
  }
  if (count==0) {
   test+= "<span><a style='color:white' href=#>THERE ARE NO PROFESSORS IN THIS CATEGORY</a></span>";
  }
  document.getElementById('<?php echo $div_id; ?>').innerHTML = test;
}

function resetDirectoryForm() {
    $(".sti-faculty-sort a").data("active", false);
    $(".sti-faculty-sort a#all").data("active", true);
    redraw();
    return false;  // For the onClick() handler to suppress the event
}

function redraw () {
    var $institute = <?php echo ($institute ? "\"$institute\"" : undefined); ?>;
    $(".sti-faculty-sort a").map(function (unused_index, e) {
        if ($(e).data("active")) {
            $(e).addClass('sti-toggled');
        } else {
            $(e).removeClass('sti-toggled');
        }
    })

    function anchor2cgiparam (id) {
        return ($("#" + id).data("active") ? "1" : "0");
    }

    var PO = anchor2cgiparam("PO"),
        PA = anchor2cgiparam("PA"),
        PATT = anchor2cgiparam("PATT"),
        PT = anchor2cgiparam("PT"),
        MER = anchor2cgiparam("MER");
    var url = "https://stisrv13.epfl.ch/cgi-bin/whoop/faculty-and-teachers2.pl?PO="+PO+"&PA="+PA+"&PATT="+PATT+"&PT="+PT+"&MER="+MER;
    if ($institute) {
      url = url + "&" + $institute + "=1";
    } else {
      var IBI2 = anchor2cgiparam("IBI2"),
        IEL = anchor2cgiparam("IEL"),
        IGM = anchor2cgiparam("IGM"),
        IMT = anchor2cgiparam("IMT"),
        IMX = anchor2cgiparam("IMX")
      url = url+"&IBI2="+IBI2+"&IEL="+IEL+"&IGM="+IGM+"&IMT="+IMT+"&IMX="+IMX;
    }
    console.log(url);
    $.ajax({
        url: url,
        dataType: "json",
}).done(function(people_listing) {
    _doPrintOuter(people_listing, "en");
});
}

function toggle (this_link) {
    $(".sti-faculty-sort a#all").data("active", false);
    var oldState = $(this_link).data("active");
    $(this_link).data("active", ! oldState);
    redraw();
    return false;  // For the onClick() handler to suppress the event
}

$(function() {
    $("#all").data("active", true);
    redraw();
});

</script>

<style type="text/css">
</style>

<div class="sti-faculty-sort row no-gutters buttons">
 <div class="col-md-3">
  <a href="#" onClick="javascript:return resetDirectoryForm();" id="all"><?php echo ___("All Faculty"); ?></a>
  </div>
  <div class="col-md-3">
  <a href="#" onClick="javascript:return toggle(this);" id="PO"><?php    echo __x("Full Professors",      "faculty gallery widget");?></a>
  <a href="#" onClick="javascript:return toggle(this);" id="PA"><?php    echo __x("Associate Professors", "faculty gallery widget");?></a>
  </div>
  <div class="col-md-3">
  <a href="#" onClick="javascript:return toggle(this);" id="PATT"><?php  echo __x("Assistant Professors", "faculty gallery widget");?></a>
  <a href="#" onClick="javascript:return toggle(this);" id="PT"><?php    echo __x("Adjunct Professors",   "faculty gallery widget");?></a>
  </div>
  <div class="col-md-3">
  <a href="#" onClick="javascript:return toggle(this);" id="MER"><?php   echo __x("Senior Scientists",    "faculty gallery widget");?></a>
  </div>
 </div>
<?php if (! $institute): ?>
 <div class="sti-faculty-sort row no-gutters buttons">
  <div class="col-md-3">
   <a href="#" onClick="javascript:return toggle(this);" id="IBI2"><?php  echo __x("Bioengineering",         "faculty gallery widget");?></a>
   <a href="#" onClick="javascript:return toggle(this);" id="IEL"><?php   echo __x("Electrical Engineering", "faculty gallery widget");?></a>
  </div>
  <div class="col-md-3">
   <a href="#" onClick="javascript:return toggle(this);" id="IMX"><?php   echo __x("Materials Science",      "faculty gallery widget");?></a>
   <a href="#" onClick="javascript:return toggle(this);" id="IGM"><?php   echo __x("Mechanical Engineering", "faculty gallery widget");?></a>
  </div>
  <div class="col-md-3">
   <a href="#" onClick="javascript:return toggle(this);" id="IMT"><?php   echo __x("Microengineering",       "faculty gallery widget");?></a>
  </div>
 </div>
<?php endif; ?>
</div>
    <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-3 col-md-9">

          <div class="row">

	<div id="<?php echo $div_id; ?>" class="row entry-body results ">&nbsp;</div>
</div></div></div></div>

</directory>
<?php

  }  // public function widget

  public function form ($config)
  {
    $title_id   = $this->get_field_id  ('institute');
    $title_name = $this->get_field_name('institute');
    printf("<label for=\"%s\">%s</label>", $title_id,
           __x('Institute:', 'faculty-gallery wp-admin'));
    printf("<input type=\"text\" id=\"$title_id\" name=\"$title_name\" value=\"%s\">", esc_html($config["institute"]));
  }

  public function update( $new_config, $old_config )
  {
    $config = $old_config;
    $config["institute"] = wp_strip_all_tags(strtoupper($new_config["institute"]));
    return $config;
  }

}

register_widget(FacultyGallery::class);
