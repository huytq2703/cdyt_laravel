export const formatURLParams = obj => {
    // eslint-disable-next-line no-restricted-syntax
    for (const propName in obj) {
      if (obj[propName] === null || obj[propName] === undefined || obj[propName] === '') {
        // eslint-disable-next-line no-param-reassign
        delete obj[propName]
      }
    }
    return obj
  }
