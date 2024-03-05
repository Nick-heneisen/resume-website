function weekReader() {
    const req = new XMLHttpRequest();

    req.open("GET", "matchups.txt", true)
    req.send();


    req.onload = function() {

        function removeOld() {
            while(true) {
                try {
                    let start = document.querySelector('#matchuprow')
                    start.remove();
                    continue;
                } catch {
                    console.log('nothing to remove.')
                    break;
                }
            }
        }

        removeOld();

        let weekText = this.responseText;
        const weekIndex = getWeekIndex();
        let endAt = weekIndex;
        let finishedAdding = false;
        let games = ['game16', 'game15', 'game14', 'game13', 'game12', 'game11', 'game10', 'game9', 'game8', 'game7', 'game6', 'game5', 'game4', 'game3', 'game2', 'game1'];

        function getTeam(startIndex) {
            let name = [];
            let j = startIndex;
            while (weekText[j] != "@" && weekText[j] != "," && weekText[j] != "." && weekText[j] != "?") {

                name.push(weekText[j]);
                if (j++ >= weekText.length) return "error";

            }

            if (weekText[j] == ".") {
                endAt = j + 3;
            } else if (weekText[j] == "?") {
                finishedAdding = true;
            } else {
                endAt = j + 1;
            }

            let finished = name.join();
            finished = finished.replaceAll(",", "");
            return finished;
        }

        function getMatchup(startIndex) {
            let k = startIndex;
            let team1 = [];
            let team2 = [];

            team1 = getTeam(k);
            team2 = getTeam(k + team1.length + 1);
            let teams = [team1, team2];

            return teams;
        }

        function getWeekIndex() {
            let l = 0;
            var week = document.getElementById("weeks").value.toString();

            while (!week.includes(weekText[l])) {

                if (l++ >= weekText.length) return "error";
            }

            return l + 3;
        }

        function addMatchups() {

            const formDiv = document.createElement('form');
            formDiv.setAttribute('action', 'predic-submit.php');
            formDiv.setAttribute('method', 'POST');
            const rowDiv = document.createElement('div');
            rowDiv.setAttribute('class', 'row');
            rowDiv.setAttribute('id', 'matchuprow');


            let start = document.querySelector('#startReq');
            for (let u = 0; u < 3; u++) {
                const teams = getMatchup(endAt);

                const team1 = teams[0];
                const team2 = teams[1];

                if (team1 != '-') {
                    const team1Name = team1.charAt(0).toUpperCase() + team1.slice(1);
                    const team2Name = team2.charAt(0).toUpperCase() + team2.slice(1);

                    const columnDiv = document.createElement('div');
                    columnDiv.setAttribute('class', 'four columns centered');
        
                    const groupDiv1 = document.createElement('div');
                    groupDiv1.setAttribute('class', 'checkboxgroup');
                    const labelDiv1 = document.createElement('label');
                    labelDiv1.setAttribute('for', team1);
                    labelDiv1.innerText = team1Name;
                    const radioButton1 = document.createElement('input');
                    radioButton1.setAttribute('type', 'radio');
                    radioButton1.setAttribute('name', games[games.length - 1]);
                    radioButton1.setAttribute('id', team1);
        
                    const atP = document.createElement('p');
                    atP.setAttribute('class', 'at');
                    atP.innerText = 'at';
        
                    const groupDiv2 = document.createElement('div');
                    groupDiv2.setAttribute('class', 'checkboxgroup');
                    const labelDiv2 = document.createElement('label');
                    labelDiv2.setAttribute('for', team2);
                    labelDiv2.innerText = team2Name;
                    const radioButton2 = document.createElement('input');
                    radioButton2.setAttribute('type', 'radio');
                    radioButton2.setAttribute('name', games.pop());
                    radioButton2.setAttribute('id', team2);

                    formDiv.appendChild(rowDiv);
                    rowDiv.appendChild(columnDiv);
                    columnDiv.appendChild(groupDiv1);
                    groupDiv1.appendChild(labelDiv1);
                    groupDiv1.appendChild(radioButton1);
                    columnDiv.appendChild(atP);
                    columnDiv.appendChild(groupDiv2);
                    groupDiv2.appendChild(labelDiv2);
                    groupDiv2.appendChild(radioButton2);
                    const lineBreak = document.createElement('br');
                    rowDiv.insertAdjacentElement("afterend", lineBreak);

                } else {
                    const columnDiv = document.createElement('div');
                    columnDiv.setAttribute('class', 'four columns centered');
                    const lineBreak = document.createElement('br');

                    rowDiv.appendChild(columnDiv);
                    columnDiv.appendChild(lineBreak);
                }
            }
    
            //let start = document.querySelector('#startReq');
            start.insertAdjacentElement("beforeend", rowDiv);

        }

        while (!finishedAdding) {
            addMatchups();
        }
    }
}

