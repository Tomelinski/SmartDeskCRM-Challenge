<?php

include("./includes/header.php");


if($_SERVER['REQUEST_METHOD'] == "GET"){
  //unserialize($campaignDetails);
  // print_r("test". $campaignDetails->campaignName);
  // print_r("<br/>variable: ". $campaignDetails['campaignName']);
  // print_r("</br>session: ". $_SESSION['campaignDetails']);

  $campaignName=$campaignDetails->campaignName;

  $source=$campaignDetails->source;
  $medium=$campaignDetails->medium;
  $campaign=$campaignDetails->campaign;
  $term=$campaignDetails->term;
  $content=$campaignDetails->content;

  $clickGoal=$campaignDetails->clickGoal;
  $leadGoal=$campaignDetails->leadGoal;
  $effGoal=$campaignDetails->effGoal;
  $budget=$campaignDetails->budget;

  $startDate=$campaignDetails->startDate;
  $endDate=$campaignDetails->endDate;

  $revGoal=$campaignDetails->revGoal;

  $revAtt=7000;
  $currentLeads=150;
  $currentClicks=8000;
  $revAtt=7000;
  $lead=790;
  $totalLeadsValue=34000;
  $won=123;
  $avgRev=round($revAtt/$won,2);
  $avgLead=round($totalLeadsValue/$lead,2);
  $avgCurrentLead=round($revGoal/$leadGoal,2);
  $lost=76;
  $conversionRate=round($avgRev/($avgRev+$lead+$lost) * 100);


  $mktEff=round(($currentLeads/$currentClicks)*100);
}

function getDates($startDay, $endDay){
  $start = new DateTime( $startDay );
  $end   = new DateTime( $endDay );

  for($i = $start; $i <= $end; $i->modify('+1 day')){
    if($i < $end){
      echo "\"" . $i->format("Y-m-d") . "\", ";

    }else{
      echo "\"" . $i->format("Y-m-d") . "\"";

    }
  }  
}

?>   

<h1>Campaign Dashboard</h1>

    <div class="row mb-3">
      <label for="campaignName" class="col-sm-3 col-form-label">Campaign Name</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="campaignName" value="<?php echo@$campaignName; ?>" readonly>
      </div>
    </div>

  <div class="row ml-auto mb-3 justify-content-evenly">
    <div class="col-4 text-center">
      <h6>Marketing Efficiency</h6>
      <div  class="d-inline-block w-50">
        <h1 class="rounded-bg"> <?php echo $mktEff; ?>%</h1>
      </div>
    </div>
    <div class="col-4 text-center ">
      <h6>Conversion Rate</h6>
      <div class="d-inline-block w-50">
        <h1 class="rounded-bg"><?php echo $conversionRate; ?>%</h1>
      </div>
    </div>
    <div class="col-4 text-center ">
      <h6>Revenue Attribution</h6>
      <div class="d-inline-block w-75">
        <h1 class="rounded-bg">$<?php echo $revAtt; ?></h1>
      </div>
    </div>
  </div>

  <h4>UTM Parameters</h4>
  <div class="row ml-auto mb-3">
    <div class="col-2">
      <label>Source</label>
      <div>
        <input type="text" id="source" value="<?php echo $source; ?>" readonly>
      </div>
    </div>
    <div class="col-2">
      <label>Medium</label>
      <div>
        <input type="text" id="medium" value="<?php echo $medium; ?>" readonly>
      </div>
    </div>
    <div class="col-2">
      <label>Campaign</label>
      <div>
        <input type="text" id="campaign" value="<?php echo $campaign; ?>" readonly>
      </div>
    </div>
    <div class="col-2">
      <label>Term</label>
      <div>
        <input type="text" id="term" value="<?php echo $term; ?>" readonly>
      </div>
    </div>
    <div class="col-2">
      <label>Content</label>
      <div>
        <input type="text" id="content" value="<?php echo $content; ?>" readonly>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-2 ">
      <label class="d-inline-block">Clicks</label>
      <div class="rounded-bg text-center w-50 d-inline-block">
        <span id="clicks"><?php echo number_format($currentClicks,0); ?></span>
      </div>
    </div>
  </div>

  <div class="row">
    <span class="ml-auto">Goal <?php echo $leadGoal; ?></span>
  </div>
  <div class="row mb-3">
    <div class="col-2">
      <div class="d-inline">
        <label>Leads</label>
        <div class="rounded-bg text-center w-50 d-inline-block">
          <span><?php echo $currentLeads; ?></span>
        </div>
      </div>
    </div>
    <div class="col-10">
      <div class="progress mb-3">
        <div class="progress-bar d-inline-block" role="progressbar" style="width: <?php echo ($currentLeads/$leadGoal)*100 ?>%" aria-valuemin="0" aria-valuemax="100">
          <span class="float-left ml-2">Currrent</span>
          <span class="float-right mr-2"><?php echo $currentLeads; ?></span>
        </div>
      </div>
    </div>
  </div>


  <div class="row mb-3">
    <table class="table">
      <tbody>
        <tr>
          <td>Mktg Eff.</td>
          <td> <?php echo $mktEff; ?>%</td>
          <td>Click's Goal</td>
          <td><?php echo number_format($clickGoal,0); ?></td>
          <td>Lead's Goal</td>
          <td><?php echo $leadGoal; ?></td>
          <td>Eff. Goal</td>
          <td><?php echo $effGoal; ?>%</td>
          <td>Budget</td>
          <td>$<?php echo number_format($budget,2); ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Custom tabs (Charts with tabs)-->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Leads over time
      </h3>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content p-0">
        <!-- Morris chart - Sales -->
        <div class="chart active" style="position: relative; height: 400px;">
          <canvas id="myChart" class="h-100"></canvas>
        </div>
      </div>
    </div><!-- /.card-body -->
  </div>
  <!-- /.card -->


  <div>
    <h4>
      Campaign Details
    </h4>
    <table class="table">
      <tbody>
        <tr>
          <td>Lead</td>
          <td><?php echo number_format($lead,0); ?></td>
          <td>Target Leads</td>
          <td><?php echo number_format($leadGoal,0); ?> </td>
          <td>Won</td>
          <td><?php echo number_format($won,0); ?></td>
          <td>Conversion</td>
          <td><?php echo $conversionRate; ?>%</td>
        </tr>
        <tr>
          <td>Total Leads Value</td>
          <td>$<?php echo number_format($totalLeadsValue,2); ?></td>
          <td>Target Rev.</td>
          <td>$<?php echo number_format($revGoal,2); ?></td>
          <td>Rev. Attrib</td>
          <td>$<?php echo number_format($revAtt,2); ?></td>
          <td>Target Conv Rate</td>
          <td><?php echo $effGoal; ?>%</td>
        </tr>
        <tr>
          <td>Avg Deal Size</td>
          <td>$<?php echo number_format($avgLead,2); ?></td>
          <td>Avg Deal Size</td>
          <td>$<?php echo number_format($avgCurrentLead,2); ?></td>
          <td>Avg Rev</td>
          <td>$<?php echo number_format($avgRev,2); ?></td>
          <td>Lost</td>
          <td><?php echo $lost; ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <script>
      let myChart1 = document.getElementById('myChart').getContext('2d');

      let massPopChart = new Chart(myChart1, {
        type:'line',
        data:{
          labels:[<?php getDates($startDate, $endDate); ?>],
          datasets:[{
            label:'Leads over time',
            data:[
              5,
              <?php echo ($currentLeads-($currentLeads/1.5)) ?>,
              <?php echo ($currentLeads-($currentLeads/2)) ?>,
              <?php echo ($currentLeads-($currentLeads/3)) ?>,
              <?php echo ($currentLeads-($currentLeads/4)) ?>,
              <?php echo $currentLeads ?>
            ],
            backgroundColor:[
              'rgba(125, 125, 125, 0.6)',
            ],
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3,
            hoverBorderColor:'#000'
          }]
        },
    options: {
        scales: {
            y: {
                suggestedMax: <?php echo $leadGoal ?>
            }
        }
    }
      });
    </script>

<?php
include("./includes/footer.php");
?>    