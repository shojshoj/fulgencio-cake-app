const customLightTheme = {
    dark: false,
    colors: {
        primary: '#388E3C',
        secondary: '#689F38',
        accent: '#8BC34A',
        error: '#F44336',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FFC107',
        background: '#E0E0E0',
    },
};

const customDarkTheme = {
    dark: true,
    colors: {
        primary: '#388E3C',
        secondary: '#689F38',
        accent: '#7CB342',
        error: '#D32F2F',
        info: '#1976D2',
        success: '#43A047',
        warning: '#FFA000',
        background: '#212121',
    },  
};

//Light and Dark Themes doesn't work

export default {
    theme: {
        defaultTheme: "customLightTheme",
        themes: {
          customLightTheme,
          customDarkTheme
        },
    },
};