'use strict';

const test = () => {
    const primes = [2, 3, 5, 7, 11];

    const definedPrimes = primes.map( (prime, index) => {
        return (index + 1)  + '. Primzahl: '  + prime;
    } )
}


module.exports = test;