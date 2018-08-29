/**
 * Helper pour extraire les scores des feuilles de score
 * Pour le moment peut extraire les cases sous forme d'image
 * 
 */
class ScoreExtractorHelper {
}
;



ScoreExtractorHelper.prototype.convertImageToCanvas = function (image) {
    var canvas = document.createElement("canvas");
    canvas.width = image.width;
    canvas.height = image.height;
    canvas.getContext("2d").drawImage(image, 0, 0, image.width, image.height);
    return canvas;
};


// Converts canvas to an image (png)

ScoreExtractorHelper.prototype.convertCanvasToImage = function (canvas) {
    var image = new Image();
    image.src = canvas.toDataURL("image/png");
    return image;
};

// Converts imageData to a canvas
ScoreExtractorHelper.prototype.convertImageDataToCanvas = function (imageData) {
    var canvas = document.createElement("canvas");
    canvas.width = imageData.width;
    canvas.height = imageData.height;
    canvas.getContext("2d").putImageData(imageData, 0, 0);
    return canvas;
};

// get an image of square by canvas context
ScoreExtractorHelper.prototype.getSquareImageByContext = function (context, column, line, squareWidth, squareHeight, offsetX, offsetY) {
    var squareImage = context.getImageData(offsetX + (line - 1) * squareWidth, offsetY + (column - 1) * squareHeight, squareWidth, squareHeight);

    var newCanvas = this.convertImageDataToCanvas(squareImage);
    var image = this.convertCanvasToImage(newCanvas);

    return image;

};

/**
 * Renvoie le carré d'une feuille en fonnction de sa colonne et de sa ligne
 * L'options sourceType est par defaut à "imagePath", peut etre aussi "canvas" ou "context" 
 * 
 * @param {string|canvas|context} source - Chemin d'image, canvas ou context
 * @param {number} column 
 * @param {number} line
 * @param {object} options
 * @returns {Image}
 */
ScoreExtractorHelper.prototype.getSquareImage = function (source, column, line, options) {

    options = $.extend({
        initialPixelX: 340,
        initialPixelY: 830,

        widthBox: 124,
        heightBox: 99.5,

        sourceType: "imagePath"
    }, options);

    var canvas;
    var context;

    switch (options.sourceType) {
        case "imagePath":
            var image = new Image();
            image.src = source;
            canvas = this.convertImageToCanvas(image);
            context = canvas.getContext("2d");
            break;
        case "canvas":
            canvas = source;
            context = canvas.getContext("2d");
            break;
        case "context":
            context = source;
            break;

        default:
            return false;
            break;
    }

    return this.getSquareImageByContext(context, column, line, options.widthBox, options.heightBox, options.initialPixelX, options.initialPixelY);
};

/**
 * Récupérer tous les carrés d'une feuille dans un tableau 2d
 * @param {string} imagePath
 * @param {number} lineNumber
 * @param {number} columnNumber
 * @returns {Array}
 */
ScoreExtractorHelper.prototype.getAllSquareFromImage = function (imagePath, lineNumber, columnNumber) {
    var image = new Image();
    image.src = imagePath;

    var canvas = this.convertImageToCanvas(image);
    var context = canvas.getContext("2d");

    var dimentionalArray = [];

    for (var u = 1; u <= lineNumber; u++) {
        var lineArray = [];
        for (var i = 1; i <= columnNumber; i++) {
            var image = this.getSquareImage(context, u, i, {sourceType: "context"});

            lineArray.push(image);
        }
        dimentionalArray.push(lineArray);
    }
    return dimentionalArray;


};


