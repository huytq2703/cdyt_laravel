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

export const getTimeSlots = async () => {
    return await AxiosInstance({
        url: `/v1/time-slot`,
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
