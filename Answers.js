$(function() {
	//Hauptfunktion
});

var currentQuestionNo = 0;
var points = 0;
var rightAnswerPoints = 10;
var currentQuestion;

var questions = [
	{
		"id":"1",
		"question" : "Frage Nummer 1",
		"answers" : {
			"A":"Antwort 1",
			"B":"Antwort 2",
			"C":"Antwort 3",
			"D":"Antwort 4"
		},
		"right":"C"
	},{
		"id":"2",
		"question" : "Frage Nummer 2",
		"answers" : {
			"A":"Antwort 1",
			"B":"Antwort 2",
			"C":"Antwort 3",
			"D":"Antwort 4"
		},
		"right":"A"
	}		
]; 

function showNextQuestion() {
	console.log("Loading Question:" + currentQuestionNo);
	currentQuestion = questions[currentQuestionNo];
	
	$("#qno").text(currentQuestionNo + 1);
	$("#question_text").text(currentQuestion.question);
	$("#question_a").text(currentQuestion.answers.A);
	$("#question_b").text(currentQuestion.answers.B);
	$("#question_c").text(currentQuestion.answers.C);
	$("#question_d").text(currentQuestion.answers.D);
} 

function getRightAnswer() {
	return currentQuestion.right;
}

