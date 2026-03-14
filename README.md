# Sneaker Store

## 1. Download Tailwind CLI

Run in the project root:

```powershell
curl -L -o tailwind.exe https://github.com/tailwindlabs/tailwindcss/releases/latest/download/tailwindcss-windows-x64.exe
```

## 2. Run Tailwind to build CSS

```powershell
.\tailwind.exe -i ./src/styles.css -o ./dist/styles.css --watch
```