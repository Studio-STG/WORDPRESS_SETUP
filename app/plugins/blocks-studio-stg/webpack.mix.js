const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');

require('mix-tailwindcss');

// Função para ler arquivos recursivamente
function getFiles(dir, extension) {
    const files = fs.readdirSync(dir);
    let fileList = [];

    files.forEach(file => {
        const filePath = path.join(dir, file);
        const stat = fs.statSync(filePath);

        if (stat.isDirectory()) {
            fileList = fileList.concat(getFiles(filePath, extension));
        } else if (file.endsWith(extension)) {
            fileList.push(filePath);
        }
    });

    return fileList;
}

// Diretórios base
const blocksDir = 'src/views/blocks';

// Pega todos os arquivos .js
const jsFiles = getFiles(blocksDir, '.js');
jsFiles.forEach(file => {
    const relativePath = path.relative(blocksDir, file); // Mantém a estrutura de pastas
    const outputPath = `public/blocks/${relativePath.replace(/\.js$/, '.js')}`;
    mix.js(file, outputPath);
});

// Pega todos os arquivos .scss
const scssFiles = getFiles(blocksDir, '.scss');
scssFiles.forEach(file => {
    const relativePath = path.relative(blocksDir, file); // Mantém a estrutura de pastas
    const outputPath = `public/blocks/${relativePath.replace(/\.scss$/, '.css')}`;
    mix.sass(file, outputPath)
        .tailwind();
});

// Adiciona autoload para jQuery
mix.autoload({
    jquery: ['$', 'window.jQuery']
});
