var scoreExtractorHelper = new ScoreExtractorHelper();

var sheetsPath = './data/captures/';
var scoresPath = './data/scores/';

var lineNumber = 19;
var columnNumber = 15;


var $sheetDiv = $('#sheet-div');
var $winnerDiv = $('#winner');
var $scoreDiv = $('#scores');

var $selectSheet = $('#select-sheet');




function showSheet(name, $target) {
    $target.html("");
    var sheetPath = sheetsPath + name;
    var imageSheet = new Image();
    imageSheet.src = sheetPath;
    $(imageSheet).addClass("img-rescale");
    $(imageSheet).appendTo($target);

}

function showWinner(seasonId, $target) {

    var url = "./src/php/api/getSeason.php";
    var data = {
        searchBy: "id",
        value: seasonId
    };
    $.post(
            url,
            data,
            function (e) {
                $target.html('');

                if (!e.season) {
                    $('<p>No season found, populate csv data !</p>').appendTo($target);
                } else {
                    $('<h3>Season ' + e.season + '</h3>').appendTo($target);
                    if (!e.winner) {
                        $('<p>No winner found for this season, populate csv data !</p>').appendTo($target);
                    } else {
                        $('<p>The winner is ' + e.winner.id + '</p>').appendTo($target);
                    }
                }
            }
    );
}




function buildScoresView(response, $target) {
    var nbGames = 0;
    
    for (var key in response.scores) {
        if (nbGames < parseInt(response.scores[key]['game'])) {
            nbGames = parseInt(response.scores[key]['game']);
        }
    }


    $target.append('<p>' + nbGames + ' parties</p>');
    $target.append('<p>Total de victoires :</p>');

    
    var $table = $('<table></table>').appendTo($target);
    var $thead = $('<thead></thead>').appendTo($table);
    var $trPlayers = $('<tr></tr>').appendTo($thead);
    var $tbody = $('<tbody></tbody>').appendTo($table);
    var $trPointsTotal = $('<tr></tr>').appendTo($tbody);

    for (var key in response.total) {
        $trPlayers.append('<th>' + key + '</th>');
        $trPointsTotal.append('<td>' + response.total[key] + '</td>');
    }

    
    $target.append('<p>Total de bulles :</p>');
    
    var $table = $('<table></table>').appendTo($target);
    var $thead = $('<thead></thead>').appendTo($table);
    var $trPlayers = $('<tr></tr>').appendTo($thead);
    var $tbody = $('<tbody></tbody>').appendTo($table);
    var $trPointsTotal = $('<tr></tr>').appendTo($tbody);

    for (var key in response.bulles) {
        $trPlayers.append('<th>' + key + '</th>');
        $trPointsTotal.append('<td>' + response.bulles[key] + '</td>');
    }
    
    
}

function showScores(seasonId, $target) {

    var url = "./src/php/api/getScores.php";
    var data = {
        searchBy: "seasonId",
        value: seasonId
    };
    $.post(
            url,
            data,
            function (response) {
                $target.html('');
                buildScoresView(response, $target);
            }
    );
}


function onSheetChangeHandler() {

    if ($selectSheet.val() !== null) {
        showSheet($selectSheet.val(), $sheetDiv);
        var saisonId = $selectSheet.val().replace('.jpg', '').replace('season_', '');
        showWinner(saisonId, $winnerDiv);
        showScores(saisonId, $scoreDiv);
    }
}




$(document).ready(function () {
    onSheetChangeHandler();
    $selectSheet.on('change', onSheetChangeHandler);

});