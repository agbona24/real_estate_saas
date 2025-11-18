import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    VStack,
    Text,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, MapPin, Users, Phone, Mail } from 'lucide-react';

const Branches = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const branches = [
        {
            id: 1,
            name: 'Downtown Office',
            address: '123 Business Blvd, Suite 500, Downtown',
            city: 'New York',
            state: 'NY',
            zip: '10001',
            phone: '+1 (555) 100-2000',
            email: 'downtown@agency.com',
            manager: 'Sarah Johnson',
            realtors: 12,
            properties: 89,
            status: 'active',
        },
        {
            id: 2,
            name: 'Suburban Branch',
            address: '456 Mall Road, Suburban Plaza',
            city: 'Brooklyn',
            state: 'NY',
            zip: '11201',
            phone: '+1 (555) 200-3000',
            email: 'suburban@agency.com',
            manager: 'Michael Chen',
            realtors: 8,
            properties: 67,
            status: 'active',
        },
        {
            id: 3,
            name: 'Coastal Office',
            address: '789 Beach Avenue, Waterfront Center',
            city: 'Long Beach',
            state: 'NY',
            zip: '11561',
            phone: '+1 (555) 300-4000',
            email: 'coastal@agency.com',
            manager: 'David Kim',
            realtors: 6,
            properties: 45,
            status: 'active',
        },
        {
            id: 4,
            name: 'Uptown Branch',
            address: '321 Park Street, Professional Tower',
            city: 'Manhattan',
            state: 'NY',
            zip: '10022',
            phone: '+1 (555) 400-5000',
            email: 'uptown@agency.com',
            manager: 'Jessica Martinez',
            realtors: 10,
            properties: 78,
            status: 'active',
        },
        {
            id: 5,
            name: 'East Side Office (Closed)',
            address: '654 Old Street, Legacy Building',
            city: 'Queens',
            state: 'NY',
            zip: '11354',
            phone: '+1 (555) 500-6000',
            email: 'eastside@agency.com',
            manager: null,
            realtors: 0,
            properties: 0,
            status: 'inactive',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Branches</Heading>
                <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                    Add Branch
                </Button>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Branch Name</Th>
                            <Th>Location</Th>
                            <Th>Contact</Th>
                            <Th>Manager</Th>
                            <Th>Realtors</Th>
                            <Th>Properties</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {branches.map((branch) => (
                            <Tr key={branch.id}>
                                <Td fontWeight="semibold">{branch.name}</Td>
                                <Td>
                                    <VStack align="start" spacing={1}>
                                        <HStack spacing={2}>
                                            <MapPin size={14} />
                                            <Text fontSize="sm">{branch.address}</Text>
                                        </HStack>
                                        <Text fontSize="sm" color="gray.500" pl={5}>
                                            {branch.city}, {branch.state} {branch.zip}
                                        </Text>
                                    </VStack>
                                </Td>
                                <Td>
                                    <VStack align="start" spacing={1}>
                                        <HStack spacing={2}>
                                            <Phone size={14} />
                                            <Text fontSize="sm">{branch.phone}</Text>
                                        </HStack>
                                        <HStack spacing={2}>
                                            <Mail size={14} />
                                            <Text fontSize="sm">{branch.email}</Text>
                                        </HStack>
                                    </VStack>
                                </Td>
                                <Td fontSize="sm">{branch.manager || 'N/A'}</Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <Users size={16} />
                                        <Text>{branch.realtors}</Text>
                                    </HStack>
                                </Td>
                                <Td>{branch.properties}</Td>
                                <Td>
                                    <Badge colorScheme={branch.status === 'active' ? 'green' : 'gray'}>
                                        {branch.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="Edit branch"
                                        />
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete branch"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Branches;
