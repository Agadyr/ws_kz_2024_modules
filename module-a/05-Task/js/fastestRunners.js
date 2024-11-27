// Sample runner data
const runners = [
	{ "name": "Alice", "paces": ["5:50", "6:00", "6:06", "6:07", "6:08", "6:19", "6:28"] },
	{ "name": "Bob", "paces": ["6:20", "6:24", "6:36", "6:48", "6:53", "6:58", "6:59"] },
	{ "name": "Charlie", "paces": ["6:09", "6:19", "6:20", "6:28", "6:36", "6:34", "6:44"] },
	{ "name": "Dave", "paces": ["6:06", "6:04", "6:15", "6:23", "6:22", "6:27", "6:37"] },
	{ "name": "Eve", "paces": ["6:18", "6:30", "6:41", "6:52", "6:50", "6:49", "6:57"] },
	{ "name": "Frank", "paces": ["5:04", "5:07", "5:06", "5:17", "5:28", "5:39", "5:51"] },
	{ "name": "Grace", "paces": ["6:14", "6:17", "6:28", "6:35", "6:34", "6:43", "6:41"] },
	{ "name": "Heidi", "paces": ["6:04", "6:04", "6:13", "6:20", "6:25", "6:27", "6:34"] },
	{ "name": "Ivan", "paces": ["6:37", "6:41", "6:44", "6:48", "6:53", "6:58", "7:01"] },
	{ "name": "Judy", "paces": ["6:10", "6:10", "6:16", "6:16", "6:21", "6:33", "6:42"] },
	{ "name": "Karen", "paces": ["5:16", "5:27", "5:30", "5:33", "5:40", "5:49", "5:50"] },
	{ "name": "Larry", "paces": ["5:41", "5:51", "5:59", "6:05", "6:10", "6:18", "6:26"] },
	{ "name": "Mallory", "paces": ["6:27", "6:38", "6:44", "6:50", "6:56", "7:04", "7:12"] },
	{ "name": "Nancy", "paces": ["6:20", "6:21", "6:28", "6:37", "6:35", "6:39", "6:51"] },
	{ "name": "Oscar", "paces": ["5:28", "5:30", "5:37", "5:35", "5:34", "5:39", "5:50"] },
	{ "name": "Peggy", "paces": ["5:25", "5:25", "5:29", "5:34", "5:44", "5:49", "5:53"] },
	{ "name": "Quinn", "paces": ["5:58", "5:57", "5:58", "5:59", "5:59", "6:02", "6:01"] },
	{ "name": "Robert", "paces": ["6:32", "6:30", "6:33", "6:32", "6:42", "6:40", "6:45"] },
	{ "name": "Susan", "paces": ["6:36", "6:43", "6:54", "7:00", "7:07", "7:18", "7:16"] },
	{ "name": "Tim", "paces": ["6:25", "6:23", "6:30", "6:29", "6:33", "6:39", "6:51"] },
	{ "name": "Ursula", "paces": ["6:02", "6:11", "6:21", "6:25", "6:37", "6:41", "6:48"] },
	{ "name": "Victor", "paces": ["6:11", "6:12", "6:16", "6:23", "6:29", "6:35", "6:46"] },
	{ "name": "Wendy", "paces": ["6:10", "6:17", "6:20", "6:18", "6:29", "6:34", "6:37"] },
	{ "name": "Xavier", "paces": ["6:35", "6:36", "6:43", "6:48", "6:52", "6:50", "6:56"] },
	{ "name": "Yvonne", "paces": ["6:27", "6:28", "6:26", "6:29", "6:31", "6:34", "6:37"] },
	{ "name": "Zach", "paces": ["6:10", "6:14", "6:18", "6:19", "6:21", "6:22", "6:29"] }
  ];
  
  function paceToSeconds(pace) {
	const [min, sec] = pace.split(':').map(Number);
	return min * 60 + sec;
  }
  
  function secondsToPace(seconds) {
	const min = Math.floor(seconds / 60);
	const sec = seconds % 60;
	return `${min}:${sec < 10 ? '0' : ''}${sec}`;
  }
  
  function calculateTotalTime(runner) {
	if (!runner.paces || runner.paces.length === 0) {
	  return 0;
	}
	return runner.paces.reduce((total, pace) => total + paceToSeconds(pace), 0);
  }
  
  function calculateRunnerStats(runner) {
	const totalTime = calculateTotalTime(runner);
	const averageTime = totalTime / runner.paces.length;
	const averagePace = secondsToPace(averageTime);
	const fastestPace = runner.paces.reduce((fastest, pace) => {
	  return paceToSeconds(pace) < paceToSeconds(fastest) ? pace : fastest;
	});
  
	return {
	  name: runner.name,
	  averagePace: averagePace,
	  fastestPace: fastestPace
	};
  }
  
  const totalRunnersTime = runners.map(runner => calculateTotalTime(runner)).reduce((a, b) => a + b, 0);
  const overallAverageTime = totalRunnersTime / runners.length;
  
  const fastestRunners = runners
	.map(calculateRunnerStats)
	.filter(runner => calculateTotalTime(runner) < overallAverageTime)
	.sort((a, b) => calculateTotalTime(a) - calculateTotalTime(b));
  
  function displayFastestRunners() {
	const fastestDiv = document.getElementById('fastest');
	fastestDiv.innerHTML = '<h2 class="font-bold text-xl">The fastest runners are:</h2>';
  
	fastestRunners.forEach(runner => {
	  const runnerElement = document.createElement('div');
	  runnerElement.classList.add('mb-2', 'text-center', 'text-slate-700');
	  runnerElement.innerHTML = `
		<strong>${runner.name}</strong> - 
		Average Pace: ${runner.averagePace}, 
		Fastest Pace: ${runner.fastestPace}
	  `;
	  fastestDiv.appendChild(runnerElement);
	});
  }
  
  displayFastestRunners();
  