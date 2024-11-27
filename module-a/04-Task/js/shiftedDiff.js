/**
 * Write a function that receives two strings and returns the number of characters we would need to rotate the first string forward to match the second.
 *
 * @param {String} first
 * @param {String} second
 * @return {Number}
 */

function shiftedDiff() {
	const message = document.getElementById('message')

	let string1 = document.getElementById('string1').value
	let string2 = document.getElementById('string2').value

	if (string1.length !== string2.length) {
		message.innerHTML = `This strings not equal by length -1`
		return null
	}

	let count = 0

    while (count < string1.length) {
        if (string1 === string2) {
            message.innerHTML = `${count} shifts`;
            return count;
        }

        string1 = string1[string1.length - 1] + string1.slice(0, -1);
        count++;
    }

    message.innerHTML = `Strings cannot be matched by rotation: -1`;
	return -1
}
