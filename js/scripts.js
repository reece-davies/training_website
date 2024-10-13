function viewProgramme(id)
{
    window.location = "./unique-programme.php?proid=" + id;
}

function newCircuitPage(id)
{
    window.location = "./new-circuit.php?proid=" + id;
}

function addExercise()
{
    document.getElementById("input-exercise").innerHTML = document.getElementById("input-exercise").innerHTML + '<div style="font-size: 17px; font-weight: bold; text-align: center;">    -- Exercise --    </div> <span class="txt1 p-b-11"> Exercise Title </span> <div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise is required"> <input class="input101" type="text" name="circEx[]" > <span class="focus-input101"></span> </div> <span class="txt1 p-b-11"> Exercise Weight </span> <div class="wrap-input101 validate-input m-b-36" data-validate = "Weight is required"> <input class="input101" type="text" name="circWeight[]" > <span class="focus-input101"></span> </div> <span class="txt1 p-b-11"> Exercise Reps </span> <div class="wrap-input101 validate-input m-b-36" data-validate = "Reps is required"> <input class="input101" type="text" name="circReps[]" > <span class="focus-input101"></span> </div>';
}

function removeExercise()
{
    document.getElementById("input-exercise").innerHTML = '<div style="font-size: 17px; font-weight: bold; text-align: center;">    -- Exercise --    </div> <span class="txt1 p-b-11"> Exercise Title </span> <div class="wrap-input101 validate-input m-b-36" data-validate = "Exercise is required"> <input class="input101" type="text" name="circEx[]" > <span class="focus-input101"></span> </div> <span class="txt1 p-b-11"> Exercise Weight </span> <div class="wrap-input101 validate-input m-b-36" data-validate = "Weight is required"> <input class="input101" type="text" name="circWeight[]" > <span class="focus-input101"></span> </div> <span class="txt1 p-b-11"> Exercise Reps </span> <div class="wrap-input101 validate-input m-b-36" data-validate = "Reps is required"> <input class="input101" type="text" name="circReps[]" > <span class="focus-input101"></span> </div>';
}

function changeTitle(programmeId, circuitId)
{
    window.location = "./alter-circuit-title.php?proid=" + programmeId + "&circid=" + circuitId;
}

function changeRest(programmeId, circuitId)
{
    window.location = "./alter-circuit-rest.php?proid=" + programmeId + "&circid=" + circuitId;
}

function changeRounds(programmeId, circuitId)
{
    window.location = "./alter-circuit-rounds.php?proid=" + programmeId + "&circid=" + circuitId;
}

function changeExercise(programmeId, circuitId, exerciseId)
{
    window.location = "./alter-circuit-exercise.php?proid=" + programmeId + "&circid=" + circuitId + "&exid=" + exerciseId;
}

function changeProgramme(programmeId)
{
    window.location = "./alter-programme.php?proid=" + programmeId;
}
