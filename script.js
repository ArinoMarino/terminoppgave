function RNGNum(min, max) { // Lager et tilfeldig tall mellom to deklarerte parametere. Min og max er inkludert
    return Math.floor(Math.random() * (max - min + 1) + min);
}


const textElement = document.getElementById('text') //deklarerer variabel textElement som diven der fortellende tekst skal være
const optionButtonsElement = document.getElementById('option-buttons') //Div for der knappene er inni


let state = {} //deklarerer state

function startGame() { // starter spillet på node 1, har med lolz som true sånn at man kan velge borgerskapet på starten
    state = {lolz:true}
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
    console.log(state)
}

var textNodes = [ //array med objekter, en for hver tekst prompt med ulike muligheter
    {
        id: 1,
        text: 'Class?????',
        options: [
            {
                text: 'BardBarian',
                setState: { barb: true },
                nextText: 3,

            },
            {
                text: 'Borgerskapet',
                nextText: 100,
                requiredState: (currentState)=> currentState.lolz
            },
            {
                text: 'WizardicianLock',
                setState: { wiz: true },
                nextText: 3
            },
            {
                text: 'Nei takk',
                nextText: 3,
            },
            
        ]

    },

    {
        id: 2,
        text: 'Du døde',
        options: [
            {
                text: 'Start på nytt',
                nextText: 0,
            },
        ]
    },
    {
        id: 3,
        text: 'Du våkner opp, hva føler du for å gjøre i dag?',
        options: [
            {
                text: 'Ta en liten skogstur',
                nextText: 4,
            },
            {
                text: 'DET ER FREDAG! dra til en taverna woop woop',
                nextText: 30,
            },
            {
                text: 'Bli hjemme',
                nextText: 3,
            },
            {
                text: 'We go jim!',
                nextText: 50,
                requiredState: (currentState)=> currentState.barb
            }
        ]
    },
    {
        id: 4,
        text: 'Du kommer til et veikryss',
        options: [
            {
                text: 'høyre',
                nextText: 5,
            },
            {
                text: 'venstre',
                nextText: 10
            }
        ]

    },


    {
        id: 10,
        text: 'Gikk deg vekk der gitt',
        options: [
            {
                text: 'let videre',
                nextText: RNGNum(10, 12)
            },
            {
                text: 'Teleporter',
                nextText: 12,
                requiredState: (currentState) => currentState.wiz
            }
        ]
    },
    {
        id: 11,
        text: 'Gikk deg vekk der gitt',
        options: [
            {
                text: 'let videre',
                nextText: RNGNum(10, 12)
            }
        ]
    },
    {
        id: 12,
        text: 'Neimen der var veien ja',
        options: [
            {
                text: 'Endelig! La oss komme oss av gårde',
                nextText: 13,
            },
            {
                text: 'la oss gå tilbake lol',
                nextText: 10
            }
        ]
    },

    {
        id: 30,
        text: 'Vibrasjonene er plettfri, men du begynner å bli tørst. Heldigvis er det flere ting å velge mellom her',
        options: [
            {
                text: 'Vann',
                setState: { dysenteri: true },
                nextText: 31
            },
            {
                text: 'Eplejuice',
                nextText: 3
            },

        ]
    },
    {
        id: 31,
        text: 'Det vannet var ikke bangin as',
        options: [
            {
                text: 'Det går sikkert fint, fest videre',
                nextText: 2,
            },
            {
                text: 'Burde prolly stikke til sykehuset',
                nextText: 40,
            },
        ]
    },
    {
        id: 40,
        text: 'Velkommen til sykehuset! Hva kan vi hjelpe deg med?',
        options: [
            {
                text: 'Vondt i magen :(',
                requiredState: (currentState) => currentState.dysenteri
            },
            {
                text: 'Helsevesenet i USA presterer dårligere i de fleste vertikaler. Høye kostnader er hovedårsaken til at amerikanere ikke får tilgang til helsetjenester. Amerikanere med inntekt under gjennomsnittet er mye mer berørt, siden det har blitt uoverkommelig å besøke en lege når de er syke, få en anbefalt test eller oppfølging. Disse pasientene har erkjent vanskelighetene med å betale medisinske regninger og andre utgifter.',
                nextText: 2,
            }

        ]
    },
{
    id: 50,
    text: 'Gym :)',
    options: [
        {
            text: 'Tren hele dagen, gå hjem og legg deg',
            nextText: 3
        }
    ]
},





    {
        id:100,
        text: 'nei huff',
        options: [
            {
            text: ' Prøv på nytt',
            setState: { lolz: false},
            nextText: 1
            }
        ]
    },
]


startGame()


