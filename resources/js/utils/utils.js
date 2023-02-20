import moment from "moment"

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


export const slugify = (string) =>{
    const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
    const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
    const p = new RegExp(a.split('').join('|'), 'g')
    return string.toString().toLowerCase()
        .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
        .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
        .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
        .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
        .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
        .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
        .replace(/đ/gi, 'd')
        .replace(/\s+/g, '-')
        .replace(p, c => b.charAt(a.indexOf(c)))
        .replace(/&/g, '-and-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '')
    }

// Format 2022-11-01T00:00:00.00Z to 11/01/2022 07:00:00
export const formatStringDateHour = (value) => {
    if (value) {
      return moment(value).format("DD/MM/YYYY HH:mm:ss");
    }
    return value;
  };

// Format 2022-11-01T00:00:00.00Z to 11/01/2022
export const formatStringDate = (value) => {
if (value) {
    return moment(value).format("DD/MM/YYYY");
}
return value;
};

// Format 2022-11-01T00:00:00.00Z to format (d-M-y | y-m-d)
export const stringDateTimeByFormat = (value, format) => {
    if (value) {
        return moment(value).format(format);
    }
    return value;
};

// convert sang không dấu
export const stringWithoutAccents = (value) => {
    if (!value) return value;
    return value
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(/[đĐ]/g, "d");
  };
