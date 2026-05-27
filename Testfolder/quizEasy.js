const backgrounds = [
    "Media/wallpaper.png",
    "Media/wallpaper2.png",
    "Media/wallpaper3.png",
    "Media/wallpaper4.png",
    "Media/wallpaper5.png"
];

const randomBg = backgrounds[Math.floor(Math.random() * backgrounds.length)];

document.body.style.backgroundImage = `url(${randomBg})`;



const questions = [
    {
        question: "Wat is de eerste Pokémon in de Pokedex?",
        answers: [
            { text: "Pikachu", correct: false},
            { text: "Bulbasaur", correct: true},
            { text: "Venusaur", correct: false},
            { text: "Charmander", correct: false},
        ]
    },
    {
        question: "Wat van tool gebruik je om Pokémon te vangen?",
        answers: [
            { text: "Tomaat", correct: false},
            { text: "Aardbei", correct: false},
            { text: "Poké ball", correct: true},
            { text: "Voltorb", correct: false},
        ]
    },
    {
        question: "Wat betekent Pokémon?",
        answers: [
            { text: "Power Monsters", correct: false},
            { text: "Post-it Monsters", correct: false},
            { text: "Pounderd Monsters", correct: false},
            { text: "Pocket Monsters", correct: true},
        ]
    },
    {
        question: "Wat is Ash Ketchum zijn favoriete Pokémon?",
        answers: [
            { text: "Charizard", correct: false},
            { text: "Pikachu", correct: true},
            { text: "Greninja", correct: false},
            { text: "Dragonite", correct: false},
        ]
    },
    {
        question: "Hoeveel Pokémon generatie's zijn er tot december 2025?",
        answers: [
            { text: "7", correct: false},
            { text: "8", correct: false},
            { text: "9", correct: true},
            { text: "12", correct: false},
        ]
    }
];

const questionElement = document.getElementById("question");
const answerButtons = document.getElementById("answerButtons");
const nextButton = document.getElementById("nextBtn");

let currentQuestionIndex = 0;
let score = 0;

function startQuiz(){
    currentQuestionIndex = 0;
    score = 0;
    nextButton.innerHTML = "Next";
    showQuestion();
}

function showQuestion(){
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    let questionNo = currentQuestionIndex + 1;
    questionElement.innerHTML = questionNo + ". " + currentQuestion.question;

    currentQuestion.answers.forEach(answer => {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        answerButtons.appendChild(button);
        if(answer.correct){
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    });
}

function resetState(){
    nextButton.style.display = "none";
    while(answerButtons.firstChild){
        answerButtons.removeChild(answerButtons.firstChild);
    }
}

function selectAnswer(e){
    const selectedBtn = e.target;
    const isCorrect = selectedBtn.dataset.correct === "true";
    if(isCorrect){
        selectedBtn.classList.add("correct");
        score++;
    }else{
        selectedBtn.classList.add("incorrect");
    }
    Array.from(answerButtons.children).forEach(button => {
        if(button.dataset.correct === "true"){
            button.classList.add("correct");
        }
        button.disabled = true;
    });
    nextButton.style.display = "block";
}

function showScore(){
    resetState();
    questionElement.innerHTML = `You scored ${score} out of ${questions.length}!`;
    nextButton.innerHTML = "Again";
    nextButton.style.display = "block";
}

function handleNextButton(){
    currentQuestionIndex++;
    if(currentQuestionIndex < questions.length){
        showQuestion();
    }else{
        showScore();
    }
}

nextButton.addEventListener("click", ()=>{
    if(currentQuestionIndex < questions.length){
        handleNextButton();
    }else{
        startQuiz();
    }
})

startQuiz();