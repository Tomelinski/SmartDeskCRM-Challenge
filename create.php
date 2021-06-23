<?php

include("./includes/header.php");

$valPerLead = 50;

if($_SERVER['REQUEST_METHOD'] == "GET"){
  $campaignName = "";
  $pipelineName = "";

  $websiteURL = "";
  $webPage = "";

  $url = "";

  $source = "";
  $medium = "";
  $capaign = "";
  $term = "";
  $content = "";

  $urlUTM = "";

  $buget = "";
  $clickGoal = "";
  $leadGoal = "";
  $mktGoal = "";
  $revGoal = "";

  $startDate ="";
  $endDate ="";

}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    
  $campaignDetails->campaignName=$campaignName = trim($_POST['campaignName']);
  $campaignDetails->pipelineName=$pipelineName = trim($_POST['pipelineName']);

  $campaignDetails->websiteURL=$websiteURL = trim($_POST['websiteURL']);
  $webPage = trim($_POST['webPage']);

  $url = $websiteURL . "/" . $webPage;

  $campaignDetails->source=$source = trim($_POST['source']);
  $campaignDetails->medium=$medium = trim($_POST['medium']);
  $campaignDetails->campaign=$campaign = trim($_POST['campaign']);
  $campaignDetails->term=$term = trim($_POST['term']);
  $campaignDetails->content=$content = trim($_POST['content']);

  $urlUTM = $url . "?utm_source=" . $source
                 . "&utm_medium=" . $medium 
                 . "&utm_campaign=" . $campaign
                 . "&utm_term=" . $term
                 . "&utm_content=" . $content;

  $campaignDetails->budget=$budget = trim($_POST['budget']);
  $campaignDetails->clickGoal=$clickGoal = trim($_POST['clickGoal']);
  $campaignDetails->leadGoal=$leadGoal = trim($_POST['leadGoal']);
  $campaignDetails->effGoal=$effGoal = (($leadGoal/$clickGoal)*100);
  $campaignDetails->revGoal=$revGoal = ($leadGoal*$valPerLead);

  $campaignDetails->startDate=$startDate = ($_POST['startDate']);
  $campaignDetails->endDate=$endDate = ($_POST['endDate']);



  $_SESSION['campaignDetails'] = serialize($campaignDetails);
  //print_r($_SESSION['campaignDetails']);
    
  redirect("./dashboard.php");


}

?>   



<h1>Create Campaign Page</h1>
<form action="<?PHP $_SERVER['PHP_SELF']; ?>" method = "POST">
  <div class="row mb-3 d-block">
    <div class="row">
      <label for="campaignName" class="col-sm-2 col-form-label">Campaign Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="campaignName">
      </div>
    </div>

    <div class="row">
      <label for="pipelineName" class="col-sm-2 col-form-label">Pipeline Name</label>
      <div class="col-sm-10">
      <select name="pipelineName" class="form-select">
        <option>Choice 1</option>
        <option>Choice 2</option>
        <option>Choice 3</option>
      </select>
      </div>
    </div>
  </div>

  <div class="row d-block mb-3">
    <div class="row">
      <label for="websiteURL" class="col-sm-2 col-form-label">Website URL</label>
      <div class="col-sm-10">
      <select id="websiteURL" name="websiteURL" onchange="updateURL()" class="form-select">
        <option selected disabled hidden >select a URL</option>
        <option>www.tom.com</option>
        <option>www.hay.ca</option>
        <option>www.three.me</option>
      </select>
      </div>
    </div>
    <div class="row mb-3">
      <label for="webPage" class="col-sm-2 col-form-label">Web Page</label>
      <div class="col-sm-10">
      <select id="webPage" name="webPage" onchange="updateURL()" class="form-select">
        <option selected disabled hidden >select a WebPage</option>
        <option>home</option>
        <option>profile</option>
      </select>
      </div>
    </div>

    <div class="row">
      <label for="url" class="col-sm-4 col-form-label">URL (Result of Web & Page)</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" onclick="copyText()" id="resultURL" name="url" value="<?php echo @$url; ?>" >
      </div>
    </div>
  </div>

  <div class="row d-block mb-3">
    <h2>UTM Parameters</h2>
    <div class="row">
      <label for="source" class="col-sm-2 col-form-label">Source</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateUTM()" id="source" name="source" value = "<?php echo @$source; ?>">
      </div>
    </div>
    <div class="row">
      <label for="medium" class="col-sm-2 col-form-label">Medium</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateUTM()" id="medium" name="medium" value = "<?php echo @$medium; ?>">
      </div>
    </div>
    <div class="row">
      <label for="campaign" class="col-sm-2 col-form-label">Campaign</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateUTM()" id="campaign" name="campaign" value = "<?php echo @$campaign; ?>">
      </div>
    </div>
    <div class="row">
      <label for="term" class="col-sm-2 col-form-label">Term</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateUTM()" id="term" name="term" value = "<?php echo @$term; ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="content" class="col-sm-2 col-form-label">Content</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateUTM()" id="content" name="content" value = "<?php echo @$content; ?>">
      </div>
    </div>

    <div class="row">
      <label for="urlUTM" class="col-sm-2 col-form-label">URL (UTM)</label>
      <div class="col-sm-8 border">
        <span id="urlUTM" name="urlUTM" ></span>
      </div>
      <button type="button" class="col-sm-2 btn btn-secondary" onclick="copyText()">Copy UTM url</button>
    </div>
  </div>

  <div class="row d-block mb-3">
    <h2>Misc. Data</h2>
    <div class="row">
      <label for="budget" class="col-sm-2 col-form-label">Budget</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="budget">
      </div>
    </div>
    <div class="row">
      <label for="clickGoal" class="col-sm-2 col-form-label">Click's Goal</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateMisc()" id="clickGoal" name="clickGoal">
      </div>
    </div>
    <div class="row">
      <label for="leadsGoal" class="col-sm-2 col-form-label">Lead's Goal</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" onchange="updateMisc()" id="leadGoal" name="leadGoal">
      </div>
    </div>
    <div class="row">
      <label for="mktGoal" class="col-sm-2 col-form-label">Mkt Eff Goal</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="effGoal" name="effGoal">
      </div>
    </div>
    <div class="row">
      <label for="revGoal" class="col-sm-2 col-form-label">Rev. Goal</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="revGoal" name="revGoal">
      </div>
    </div>
  </div>

  <div class="row d-block mb-3">
    <div class="row">
      <label class="col-sm-2 col-form-label">Start Date:</label>
      <div class="col-sm-4 col-form-label">
        <input type="date" class="form-control" name="startDate"> 
      </div>
    </div>
    <div class="row">
      <label class="col-sm-2 col-form-label">End Date:</label>
      <div class="col-sm-4 col-form-label">  
        <input type="date" class="form-control" name="endDate"> 
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Create Campaign</button>
</form>

<script>


  function updateURL(){

    let url = $("#websiteURL").val() ? $("#websiteURL").val() : "";
    let page = $("#webPage").val() ? $("#webPage").val() : "";

    $("#resultURL").attr("readonly", false);
    $("#resultURL").val(url + "/" + page);
    $("#resultURL").attr("readonly", true);
    updateUTM();
  };

  function updateUTM(){
    let url = $("#resultURL").val() ? $("#resultURL").val() : "";

    let source = $("#source").val() ? "?utm_source=" + $("#source").val() : "";
    let medium = $("#medium").val() ? "&utm_medium=" + $("#medium").val() : "";
    let campaign = $("#campaign").val() ? "&utm_campaign=" + $("#campaign").val() : "";
    let term = $("#term").val() ? "&utm_term=" + $("#term").val() : "";
    let content = $("#content").val() ? "&utm_content=" + $("#content").val() : "";

    //$("#urlUTM").attr("readonly", false);
    $("#urlUTM").html(url + source + medium + campaign + term + content);
    //$("#urlUTM").attr("readonly", true);
  };

  function updateMisc(){
    let clickGoal = $("#clickGoal").val() ? $("#clickGoal").val() : 1;
    let leadGoal = $("#leadGoal").val() ? $("#leadGoal").val() : 1;

    let effGoal = (leadGoal / clickGoal) * 100;
    let revGoal =  leadGoal * <?php echo $valPerLead; ?> ;

    $("#effGoal").val(effGoal+"%");
    $("#revGoal").val("$"+revGoal);
  };

  function copyText(){


    var copyText = document.getElementById("urlUTM");
    var textArea = document.createElement("textarea");
    textArea.value = copyText.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
  };
</script>

<?php
include("./includes/footer.php");
?>    