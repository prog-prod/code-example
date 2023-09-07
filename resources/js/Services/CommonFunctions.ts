function assetStorage(pathToFile) {
    return `/${pathToFile}`.replace("public", "storage");
}

function isClient() {
    return (
        typeof window !== "undefined" &&
        typeof window.localStorage !== "undefined"
    );
}

function asset(pathToFile) {
    return `/${pathToFile}`;
}

export { assetStorage, asset, isClient };
