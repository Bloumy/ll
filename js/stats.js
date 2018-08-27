var scoreExtractorHelper = new ScoreExtractorHelper();

var sheetsPath = './data/captures/';
var scoresPath = './data/scores/';

var lineNumber = 19;
var columnNumber = 15;


var $sheetDiv = $('#sheet-div');
var $sheetSquareDiv = $('#sheet-square-div');
var $scoreDiv = $('#scores');

var $selectSheet = $('#select-sheet');
var $selectColumn = $('#select-column');
var $selectLine = $('#select-line');

var $divSelectColumn = $('#select-column-div');
var $divSelectLine = $('#select-line-div');


function setVisibleSelectLineAndColumn(visible) {
    if (visible) {
        $divSelectColumn.removeClass("hide");
        $divSelectLine.removeClass("hide");
    } else {
        $divSelectColumn.addClass("hide");
        $divSelectLine.addClass("hide");
    }

}


function populateSelectOptions(sheet) {
    var selectColumnHtml = '<option value="" disabled="" selected="">Choose your column</option>';
    var selectLineHtml = '<option value="" disabled="" selected="">Choose your line</option>';

    if (sheet !== null) {

        for (var i = 1; i <= columnNumber; i++) {
            selectColumnHtml += '<option value="' + i + '">' + i + '</option>';
        }

        for (var i = 1; i <= lineNumber; i++) {
            selectLineHtml += '<option value="' + i + '">' + i + '</option>';
        }

    }
    $selectLine.html(selectLineHtml);
    $selectColumn.html(selectColumnHtml);

}

function showSheet(name, $target) {
    $target.html("");
    var sheetPath = sheetsPath + name;
    var imageSheet = new Image();
    imageSheet.src = sheetPath;
    $(imageSheet).addClass("img-rescale");
    $(imageSheet).appendTo($target);

}

function showScore(name, $target) {
    var scorePath = scoresPath + name;

    var url = "./score_ajax.php";
    var data = {
        score_path: scorePath
    };
    $.post(
            url,
            data,
            function (e, f) {
                $target.html('');
                $target.append(e);
            }
    );
}


function onSheetChangeHandler() {
    $sheetSquareDiv.html('');
    populateSelectOptions($selectSheet.val());
    setVisibleSelectLineAndColumn($selectSheet.val() !== null);

    if ($selectSheet.val() !== null) {
        showSheet($selectSheet.val(), $sheetDiv);
        showScore($selectSheet.val().replace('.jpg', '.csv'), $scoreDiv);
    }
}




function onColumnLineChangeHandler() {

    $sheetSquareDiv.html('');
    var sheetPath = sheetsPath + $selectSheet.val();
    var column = $selectColumn.val();
    var line = $selectLine.val();

    if (column !== null && line !== null) {
        var image = scoreExtractorHelper.getSquareImage(sheetPath, line, column, {sourceType: "imagePath"});
        $sheetSquareDiv.append(image);
    }
}



$(document).ready(function () {
    onSheetChangeHandler();
    $selectSheet.on('change', onSheetChangeHandler);
    $selectColumn.on('change', onColumnLineChangeHandler);
    $selectLine.on('change', onColumnLineChangeHandler);
});