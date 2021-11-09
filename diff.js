
const fs = require('fs')

const [baseFile, updatedFile, outFile] = process.argv.slice(2)

const base = JSON.parse(fs.readFileSync(baseFile).toString())
const updated = JSON.parse(fs.readFileSync(updatedFile).toString())

const diff = (base, updated) => {
    const entries = Object.keys(updated).map((key) => {
        if(typeof base[key] == 'object' && typeof updated[key] == 'object') {
            if(Array.isArray(base[key]) && Array.isArray(updated[key])) return [key, updated[key]]
            else return [key, diff(base[key], updated[key])]
        } else {
            if(!base[key] && updated[key]) return [key, updated[key]]
            else if(base[key] && !updated[key]) return [key, null]
            else return null
        }
    }).filter((entry) => entry)
    return Object.fromEntries(entries)
}

const out = JSON.stringify(diff(base, updated), null, '\t')
fs.writeFileSync(outFile, out)
