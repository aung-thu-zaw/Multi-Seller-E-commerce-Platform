export const __ = (key, replacements = {}) => {
  let translations = window._translations[key] || key

  Object.keys(replacements).forEach((replacement) => {
    translations = translations.replace(`:${replacement}`, replacements[replacement])
  })
  return translations
}
