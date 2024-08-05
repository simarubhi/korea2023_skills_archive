// CHAT GPT CODE

// Function to convert Roman numeral to integer
function romanToInteger(roman) {
	// Mapping of Roman numerals to integers
	const romanValues = {
		I: 1,
		V: 5,
		X: 10,
		L: 50,
		C: 100,
		D: 500,
		M: 1000,
	};

	let total = 0;
	let prevValue = 0;

	// Loop through each character in the Roman numeral string
	for (let i = 0; i < roman.length; i++) {
		const char = roman[i];
		const value = romanValues[char];

		// If the previous value is smaller, it means we need to subtract it
		if (prevValue < value) {
			total += value - 2 * prevValue;
		} else {
			total += value;
		}

		prevValue = value;
	}

	return total;
}

// Function to convert integer to Roman numeral
function integerToRoman(number) {
	// Mapping of integers to Roman numeral symbols
	const intToRoman = [
		[1000, 'M'],
		[900, 'CM'],
		[500, 'D'],
		[400, 'CD'],
		[100, 'C'],
		[90, 'XC'],
		[50, 'L'],
		[40, 'XL'],
		[10, 'X'],
		[9, 'IX'],
		[5, 'V'],
		[4, 'IV'],
		[1, 'I'],
	];

	let romanNumeral = '';

	// Iterate over the mapping and construct the Roman numeral
	for (const [value, symbol] of intToRoman) {
		while (number >= value) {
			romanNumeral += symbol;
			number -= value;
		}
	}

	return romanNumeral;
}

// Main function to convert input
function convertRomanOrInteger(inputValue) {
	if (typeof inputValue === 'string') {
		// Convert Roman numeral string to integer
		return romanToInteger(inputValue);
	} else if (typeof inputValue === 'number') {
		// Convert integer to Roman numeral string
		return integerToRoman(inputValue);
	} else {
		throw new Error(
			'Input must be either a string (Roman numeral) or an integer'
		);
	}
}

// Examples
console.log(convertRomanOrInteger('XII')); // Output: 12
console.log(convertRomanOrInteger(12)); // Output: XII
console.log(convertRomanOrInteger('IV')); // Output: 4
console.log(convertRomanOrInteger(1999)); // Output: MCMXCIX
