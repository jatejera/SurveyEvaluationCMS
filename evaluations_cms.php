<?php

require_once("./includes/connect.php");

$query = "SELECT evaluation.*, members.mID, members.mFname, members.mLname
    FROM evaluation 
    LEFT JOIN members ON evaluation.emID = members.mID
    WHERE evaluation.eID >= 20";



// ============= DATA COUNTER ===============

$answers = array();
$answers[0] = [0,0,0,0,0];
$answers[1] = [0,0,0,0,0];
$answers[2] = [0,0,0,0,0];
$answers[3] = [0,0,0,0,0];
$answers[4] = [0,0,0,0,0];

$ans = array();

$NumberOfQuestions = 5;
$AnswersPerQuestion = 5;


$question = ['1. How important do you believe sexual health is to women’s general health and well-being?','2. What percentage of your female patients links sex to overall general health, wellness and quality of life?','3. How important is proactively talking about sexual health with your female patients?','4. How important is Continuing Education for clinicians about female sexual dysfunction?','5. How important is education for patients about female sexual dysfunction?'];

// ============= DATA COUNTER ===============





function checkAnswer ($input){

    switch($input[0]){

        case('A'):
            return 0;
            break;
        case('B'):
            return 1;
            break;
        case('C'):
            return 2;
            break;
        case('D'):
            return 3;
            break;
        case('E'):
            return 4;
            break;
        default:
            return $input[0] - 1;
    }
}






if($result = $mysqli -> query($query)){

    while($row = $result->fetch_assoc()){


        $ans[0] = $row["q1"];
        $ans[1] = $row["q2"];
        $ans[2] = $row["q3"];
        $ans[3] = $row["q4"];
        $ans[4] = $row["q5"];

        foreach($ans as $key => $value){

            $number = checkanswer($ans[$key]);
            $answers[$key][$number] += 1;


        }



    }



};





?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>Starter Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

        <!-- Custom styles for this template -->
        <style type="text/css">
            body {
                padding-top: 5rem;
            }

            .starter-template {
                padding: 3rem 1.5rem;
                text-align: center;
            }
        </style>
    </head>


    <body>



        <main role="main" class="container">

            <div class="card text-center">
                <div class="card-header">Evaluations Statistics</div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <?php foreach($answers as $key => $value) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="question<?= $key + 1?>-tab" data-toggle="tab" href="#question<?= $key + 1?>" role="tab" aria-controls="question<?= $key + 1?>-tab" aria-selected="true">Q<?= $key + 1?></a>
                                    </li>
                                    <?php endforeach ?>

                                </ul>
                                <div class="tab-content" id="myTabContent">



                                    <?php foreach($answers as $key => $value) : ?>
                                    <div class="tab-pane fade" id="question<?= $key + 1?>" role="tabpanel" aria-labelledby="question<?= $key + 1?>-tab">

                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                    <?= $question[$key] ?>
                                                </h4>
                                                <div class="card-text">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Not</th>
                                                                    <th scope="col">Slightly</th>
                                                                    <th scope="col">Important</th>
                                                                    <th scope="col">Fairly</th>
                                                                    <th scope="col">Very</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?= $answers[$key][0] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $answers[$key][1] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $answers[$key][2] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $answers[$key][3] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $answers[$key][4] ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach ?>

                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>


                </div>
                <div class="card-footer text-muted">
                    <h4>The evaluation was taken
                        <?= $result->num_rows; ?> times</h4>
                </div>
            </div>

            

            <div id="dataTableAccordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Evaluations Table List (click Here to expand)</a>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#dataTableAccordion">
                        <div class="card-body">


                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Q1</th>
                                        <th scope="col">Q2</th>
                                        <th scope="col">Q3</th>
                                        <th scope="col">Q4</th>
                                        <th scope="col">Q5</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    $result = $mysqli -> query($query);
                                    $counter = 1;
                                    while($row = $result->fetch_assoc()) : 
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $counter ?>
                                        </th>


                                        <td>
                                            <?= $row['mFname'] ." ". $row['mLname'] ?>
                                        </td>
                                        <td>
                                            <?= $row['emEml'] ?>
                                        </td>

                                        <td>
                                            <?= $row['q1'] ?>
                                        </td>
                                        <td>
                                            <?= $row['q2'] ?>
                                        </td>
                                        <td>
                                            <?= $row['q3'] ?>
                                        </td>
                                        <td>
                                            <?= $row['q4'] ?>
                                        </td>
                                        <td>
                                            <?= $row['q5'] ?>
                                        </td>
                                    </tr>
                                    <?php $counter++; endwhile; ?>

                                </tbody>
                            </table>





                        </div>
                    </div>
                </div>

            </div>

        </main>
        <!-- /.container -->


        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    </body>



    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        
        var Color = ['rgba(0, 51, 204, 0.5)','rgba(255, 0, 102, 0.5)','rgba(204, 51, 255, 0.5)','rgba(0, 153, 51, 0.5)','rgba(0, 102, 102, 0.5)']
        var myRadarChart = new Chart(ctx, {
            type: 'radar',

            // The data for our dataset
            data: {
                
                labels: ["Not", "Slightly", "Important", "Fairly", "Very"],
                
                datasets: [
                    <?php foreach($answers as $key => $value) : ?>
                    {
                    
                    
                    label: "Question <?= $key +1 ?>",
                    backgroundColor: Color[<?= $key ?>],
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?= $answers[$key][0]?>, <?= $answers[$key][1]?>, <?= $answers[$key][2]?>, <?= $answers[$key][3]?>, <?= $answers[$key][4]?>],
                    
                   
                },  <? endforeach ?>]
            },

            // Configuration options go here
            options: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Number of Answers per Question'
                },
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        });

       $('document').ready(function(){
           
          $('#question1-tab').click(); 
           
       });

    </script>


    </html>