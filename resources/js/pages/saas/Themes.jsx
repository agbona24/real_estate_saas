import React from 'react';
import {
    Box,
    Button,
    Grid,
    Heading,
    useColorModeValue,
    HStack,
    Text,
    VStack,
    Image,
    Badge,
    IconButton,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, Eye, Download } from 'lucide-react';

const ThemeCard = ({ theme }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} borderRadius="xl" shadow="sm" overflow="hidden">
            <Box h="200px" bg="gray.200" position="relative">
                <Image
                    src={theme.thumbnail || 'https://via.placeholder.com/400x300'}
                    alt={theme.name}
                    objectFit="cover"
                    w="100%"
                    h="100%"
                />
                <Badge
                    position="absolute"
                    top={4}
                    right={4}
                    colorScheme={theme.status === 'active' ? 'green' : 'gray'}
                >
                    {theme.status}
                </Badge>
            </Box>
            <VStack p={5} align="start" spacing={3}>
                <Heading size="sm">{theme.name}</Heading>
                <Text fontSize="sm" color="gray.600" noOfLines={2}>
                    {theme.description}
                </Text>
                <HStack spacing={4} fontSize="sm" color="gray.500">
                    <Text>{theme.downloads} downloads</Text>
                    <Text>•</Text>
                    <Text>{theme.agencies} agencies</Text>
                </HStack>
                <HStack spacing={2} w="100%">
                    <IconButton
                        icon={<Eye size={16} />}
                        size="sm"
                        colorScheme="blue"
                        variant="outline"
                        aria-label="Preview theme"
                    />
                    <IconButton
                        icon={<Edit size={16} />}
                        size="sm"
                        colorScheme="green"
                        variant="outline"
                        aria-label="Edit theme"
                    />
                    <IconButton
                        icon={<Trash2 size={16} />}
                        size="sm"
                        colorScheme="red"
                        variant="outline"
                        aria-label="Delete theme"
                    />
                </HStack>
            </VStack>
        </Box>
    );
};

const Themes = () => {
    const themes = [
        {
            id: 1,
            name: 'Modern Luxury',
            description: 'A sleek and modern theme perfect for luxury real estate agencies',
            thumbnail: null,
            downloads: 145,
            agencies: 78,
            status: 'active',
        },
        {
            id: 2,
            name: 'Classic Professional',
            description: 'Traditional and professional design with timeless appeal',
            thumbnail: null,
            downloads: 234,
            agencies: 156,
            status: 'active',
        },
        {
            id: 3,
            name: 'Coastal Breeze',
            description: 'Light and airy theme ideal for coastal and beach properties',
            thumbnail: null,
            downloads: 89,
            agencies: 45,
            status: 'active',
        },
        {
            id: 4,
            name: 'Urban Edge',
            description: 'Bold and contemporary design for urban real estate',
            thumbnail: null,
            downloads: 67,
            agencies: 34,
            status: 'active',
        },
        {
            id: 5,
            name: 'Minimalist',
            description: 'Clean and simple design focusing on property showcasing',
            thumbnail: null,
            downloads: 123,
            agencies: 67,
            status: 'active',
        },
        {
            id: 6,
            name: 'Vintage Classic',
            description: 'Elegant vintage-inspired theme for heritage properties',
            thumbnail: null,
            downloads: 45,
            agencies: 23,
            status: 'inactive',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Themes</Heading>
                <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                    Upload Theme
                </Button>
            </HStack>

            <Grid templateColumns="repeat(auto-fill, minmax(300px, 1fr))" gap={6}>
                {themes.map((theme) => (
                    <ThemeCard key={theme.id} theme={theme} />
                ))}
            </Grid>
        </Box>
    );
};

export default Themes;
