$(function() {
});


//das ist die Codierung für den Übergang von der Startseite zu der Frage-Seite mittels eines Klicks auf den Weiter-Button//
$(".start").click(function() {
	console.log("Start");
	$(".quiz_start").fadeOut();
	startQuiz();
});

function startQuiz() {
	showNextQuestion();
	$("#question").fadeIn();
}
