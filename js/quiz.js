$(function() {
	//Diese Codierung ist dafür, dass der in html geschriebenen Code individuell auf die einzelnen Fragen angepasst wird, inklusive der Antwortmöglichkeiten//
});

var currentQuestionNo = 0;
var points = 0;
var rightAnswerPoints = 10;
var currentQuestion;

var questions = [
	{
		"id":"1",
		"question" : "Wie lautet die Antwort auf diese 1. Frage?",
		"answers" : {
			"A":"Antwort 1 auf Frage 1",
			"B":"Antwort 2 auf Frage 1",
			"C":"Antwort 3 auf Frage 1",
			"D":"Antwort 4 auf Frage 1"
		},
		"right":"C"
	},{
		"id":"2",
		"question" : "Wie lautet die Antwort auf diese 2. Frage?",
		"answers" : {
			"A":"Antwort 1 auf Frage 2",
			"B":"Antwort 2 auf Frage 2",
			"C":"Antwort 3 auf Frage 2",
			"D":"Antwort 4 auf Frage 2"
		},
		"right":"A"
	}		
]; 

function showNextQuestion() {
	console.log("Loading Question:" + currentQuestionNo);
	currentQuestion = questions[currentQuestionNo];
	
	$("#qno").text(currentQuestionNo + 1);
	$("#question_text").text(currentQuestion.question);
	$("#answer_a").text(currentQuestion.answers.A);
	$("#answer_b").text(currentQuestion.answers.B);
	$("#answer_c").text(currentQuestion.answers.C);
	$("#answer_d").text(currentQuestion.answers.D);
} 

function getRightAnswer() {
	return currentQuestion.right;
}

