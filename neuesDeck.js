// deck.js
$(document).ready(function() {
    // Add new question form
    var questionCount = 1;
    $("#addQuestionBtn").click(function() {
        questionCount++;
        var newQuestion = '<div class="question">' +
            '<label for="question' + questionCount + '">Question ' + questionCount + ':</label>' +
            '<input type="text" id="question' + questionCount + '" name="question[]" required>' +
            '<br>' +
            '<label for="answer1">Answer 1:</label>' +
            '<input type="text" id="answer' + questionCount + '1" name="answer1[]" required>' +
            '<br>' +
            '<label for="answer2">Answer 2:</label>' +
            '<input type="text" id="answer' + questionCount + '2" name="answer2[]" required>' +
            '<br>' +
            '<label for="answer3">Answer 3:</label>' +
            '<input type="text" id="answer' + questionCount + '3" name="answer3[]" required>' +
            '<br>' +
            '<label for="answer4">Answer 4:</label>' +
            '<input type="text" id="answer' + questionCount + '4" name="answer4[]" required>' +
            '<hr>' +
            '</div>';
        $("#questionsDiv").append(newQuestion);
    });
});
