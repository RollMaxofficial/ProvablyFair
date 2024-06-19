import fs from 'fs';


import pkg from 'javascript-obfuscator';
const { obfuscate } = pkg;

const appJsContent = fs.readFileSync('public/js/app.js', 'utf8');




const obfuscatedCode = obfuscate(appJsContent, {
   
    compact: true,
    controlFlowFlattening: true,
    controlFlowFlatteningThreshold: 0.75,
    identifierNamesGenerator: 'hexadecimal',
    identifiersPrefix: '',
    target: 'node'
}).getObfuscatedCode();


fs.writeFileSync('public/js/app.js', obfuscatedCode, 'utf8');
