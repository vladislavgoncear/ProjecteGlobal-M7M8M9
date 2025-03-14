const localStorageUtil = {
    setItem(key, value) {
        try {
            const serializedValue = JSON.stringify(value);
        } catch (error) {
            console.error('Error setting item in localStorage', error);
        }
    },

    getItem(key) {
        try {
            const serializedValue = localStorage.getItem(key);
            if (serializedValue === null) {
                return null;
            }
            return JSON.parse(serializedValue);
        } catch (error) {
            console.error('Error getting item from localStorage', error);
            return null;
        }
    },

    removeItem(key) {
        try {
            localStorage.removeItem(key);
        } catch (error) {
            console.error('Error removing item from localStorage', error);
        }
    },

    clear() {
        try {
            localStorage.clear();
        } catch (error) {
            console.error('Error clearing localStorage', error);
        }
    }
};

export default localStorageUtil;
