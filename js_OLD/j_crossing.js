$(function() {
});


//das ist die Codierung für den Übergang von der Startseite zu der Frage-Seite mittels eines Klicks auf den Weiter-Button//
// zusätzlich kann jede Antwort ausgewählt (selektiert) werden, so oft wie es gewollt wird und die angeklickte Antwortmöglichkeit wird dunkelblau gefärbt. // 
$(".start").click(function() {
	console.log("Start");
	$(".quiz_start").fadeOut();
	startQuiz();
});

function startQuiz() {
	showNextQuestion();
	$("#question").fadeIn();
}


function selectAnswer(id) {
	$(id).addClass("btn-primary");
	$(id).removeClass("btn-default");
}

function deselectAnswer(id) {
	$(id).addClass("btn-default");
	$(id).removeClass("btn-primary");
}

$("#answer_a_btn").click(function() {
	selectAnswer("#answer_a_btn");
	deselectAnswer("#answer_b_btn");
	deselectAnswer("#answer_c_btn");
	deselectAnswer("#answer_d_btn");
});

$("#answer_b_btn").click(function() {
	deselectAnswer("#answer_a_btn");
	selectAnswer("#answer_b_btn");
	deselectAnswer("#answer_c_btn");
	deselectAnswer("#answer_d_btn");
});

$("#answer_c_btn").click(function() {
	deselectAnswer("#answer_a_btn");
	deselectAnswer("#answer_b_btn");
	selectAnswer("#answer_c_btn");
	deselectAnswer("#answer_d_btn");
});

$("#answer_d_btn").click(function() {
	deselectAnswer("#answer_a_btn");
	deselectAnswer("#answer_b_btn");
	deselectAnswer("#answer_c_btn");
	selectAnswer("#answer_d_btn");
});

$("#answer_commit_btn").click(function() {
	validateAnswer();
});
