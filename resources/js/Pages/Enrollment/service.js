import { AxiosInstance } from "@/libs/axios";

export const getProvinces = async () => {
    return await AxiosInstance({
        url: "/v1/locations/provinces",
        method: "get",
    }).then(response => response)
    .then(res => {
        return res?.data?.data
    })
    .catch((e) => {
        console.log(e);
        return null;
    });
}

export const getDistrict = async (provinceId) => {
    return await AxiosInstance({
        url: `/v1/locations/districts/${provinceId}`,
        method: "get",
    }).then(response => response)
    .then(res => {
        return res?.data?.data
    })
    .catch((e) => {
        console.log(e);
        return null;
    });
}

export const getWards = async (districtId) => {
    return await AxiosInstance({
        url: `/v1/locations/wards/${districtId}`,
        method: "get",
    }).then(response => response)
    .then(res => {
        return res?.data?.data
    })
    .catch((e) => {
        console.log(e);
        return null;
    });
}

export const getCommonData = async () => {
    return await AxiosInstance({
        url: `/v1/common-data`,
        method: "get",
    }).then(response => response)
    .then(res => {
        return res?.data?.data
    })
    .catch((e) => {
        console.log(e);
        return null;
    });
}
