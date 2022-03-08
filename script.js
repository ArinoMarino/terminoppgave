function RNGNum(min, max) { // min og max inkludert 
    return Math.floor(Math.random() * (max - min + 1) + min);
}

var rndInt = RNGNum(1, 3); //tilfeldig tall mellom 1 og 3
console.log(rndInt)

const textElement = document.getElementById('text')
const optionButtonsElement = document.getElementById('option-buttons')


let state = {}

function startGame() { // starter spillet på node 1 med tomme states
    state = {}
    showTextNode(1)
}

function showTextNode(textNodeIndex) {
    const textNode = textNodes.find(textNode => textNode.id === textNodeIndex)
    textElement.innerText = textNode.text
    while (optionButtonsElement.firstChild) {
        optionButtonsElement.removeChild(optionButtonsElement.firstChild)
    }

    textNode.options.forEach(option => { //lager en knapp for hver option
        if (showOption(option)) {
            const button = document.createElement('button')
            button.innerText = option.text
            button.classList.add('btn')
            button.addEventListener('click', () => selectOption(option))
            optionButtonsElement.appendChild(button)
        }
    })
}

function showOption(option) { //viser options hvis alle påkrevde states er tilstede. Normalt ingen, men kan kreves
    return option.requiredState == null || option.requiredState(state)
}

function selectOption(option) {
    const nextTextNodeId = option.nextText
    if (nextTextNodeId <= 0) {
        return startGame()
    }
    state = Object.assign(state, option.setState)
    showTextNode(nextTextNodeId)
}

var textNodes = [
    {
        id: 1,
        text: 'CHARACTER CREATOR',
        options: [
            {
                text: 'next',
                nextText: 2
            },
        ]
    },
    {
        id: 2,
        text: 'choose your class',
        options: [
            {
                text: 'BardBarian',
                setState: { barb: true },
                nextText: 3,

            },
            {
                text: 'Rnger',
                setState: { rnger: true },
                nextText: 3
            },
            {
                text: 'WizardicianLock',
                setState: { wiz: true },
                nextText: 3
            },
        ]
    },
    {
        id: 3,
        text: 'You wake up in your bed feeling refreshed and well rested, what should you do today?',
        options: [
            {
                text: 'Take a walk in the woods',
                nextText: 4,
            },
            {
                text: 'Drink away your existensial dread in the local tavern',
                nextText: 3,
            },
            {
                text: 'Stay in bed',
                nextText: 3
            }
        ]
    },
    {
        id: 4,
        text: 'While walking among the trees you spot a beautiful flower. You crouch down to admire it when you hear a weird noise all around you. Then suddenly...',
        options: [
            {
                text: 'next',
                nextText: 5,
            },
        ]

    },
    {
        id: 5,
        text: 'YOU FALL! Drakness swallows you as you plummet into the caverns. Several hours later you wake up. Alive, but seemingly captured by gnelfs.' + 
        ' a' ,
        options: [
            {
                text: ' ',
                nextText: 4,
            },
        ]
    },

    {
        id: 30,
        text: 'There\'s just apple juice and water here',
        options: [
            {
                text: 'Water',
                setState: { dysentery: true },
                nextText: 31
            },
            {
                text: 'Juice',
                nextText: 32
            },

        ]
    },
    {
        id: 31,
        text: 'You died of dysentery',
        options: [
            {
                text: 'RIP',
                nextText: 1,
                startGame
            },
        ]
    },
  

]

 /*   {
        id: ,
        text: '',
        options: [
            {
                text: ' ',
                nextText: ,
            },
        ]
    }, 
    */

startGame()
console.log("Why are we still here? Just to suffer")
