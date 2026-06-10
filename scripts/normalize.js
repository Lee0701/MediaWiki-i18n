
const fs = require('fs')

const [inFile, outFile] = process.argv.slice(2)

const content = fs.readFileSync(inFile).toString()
const normalized = content.normalize('NFC')
fs.writeFileSync(outFile, normalized)
