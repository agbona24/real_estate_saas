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
    Avatar,
    VStack,
    Text,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, Eye, FileText } from 'lucide-react';

const Clients = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const clients = [
        {
            id: 1,
            name: 'John Smith',
            email: 'john.smith@email.com',
            phone: '+1 (555) 777-8888',
            properties: 2,
            totalValue: '$875,000',
            realtorAssigned: 'Sarah Johnson',
            joinDate: '2024-03-15',
            status: 'active',
            type: 'buyer',
        },
        {
            id: 2,
            name: 'Emily Davis',
            email: 'emily.davis@email.com',
            phone: '+1 (555) 888-9999',
            properties: 1,
            totalValue: '$325,000',
            realtorAssigned: 'Michael Chen',
            joinDate: '2024-06-20',
            status: 'active',
            type: 'buyer',
        },
        {
            id: 3,
            name: 'Robert Wilson',
            email: 'robert.w@email.com',
            phone: '+1 (555) 999-0000',
            properties: 3,
            totalValue: '$1,450,000',
            realtorAssigned: 'Sarah Johnson',
            joinDate: '2023-11-08',
            status: 'active',
            type: 'investor',
        },
        {
            id: 4,
            name: 'Lisa Anderson',
            email: 'lisa.a@email.com',
            phone: '+1 (555) 000-1111',
            properties: 1,
            totalValue: '$520,000',
            realtorAssigned: 'David Kim',
            joinDate: '2024-08-12',
            status: 'active',
            type: 'seller',
        },
        {
            id: 5,
            name: 'Mark Thompson',
            email: 'mark.t@email.com',
            phone: '+1 (555) 111-2222',
            properties: 0,
            totalValue: '$0',
            realtorAssigned: 'Jessica Martinez',
            joinDate: '2024-10-05',
            status: 'pending',
            type: 'buyer',
        },
        {
            id: 6,
            name: 'Susan Miller',
            email: 'susan.m@email.com',
            phone: '+1 (555) 222-3333',
            properties: 2,
            totalValue: '$780,000',
            realtorAssigned: 'Michael Chen',
            joinDate: '2023-05-22',
            status: 'inactive',
            type: 'buyer',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Clients</Heading>
                <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                    Add Client
                </Button>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Client</Th>
                            <Th>Contact</Th>
                            <Th>Type</Th>
                            <Th>Properties</Th>
                            <Th>Total Value</Th>
                            <Th>Realtor</Th>
                            <Th>Join Date</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {clients.map((client) => (
                            <Tr key={client.id}>
                                <Td>
                                    <HStack spacing={3}>
                                        <Avatar size="sm" name={client.name} />
                                        <Text fontWeight="semibold">{client.name}</Text>
                                    </HStack>
                                </Td>
                                <Td>
                                    <VStack align="start" spacing={0}>
                                        <Text fontSize="sm">{client.email}</Text>
                                        <Text fontSize="sm" color="gray.500">
                                            {client.phone}
                                        </Text>
                                    </VStack>
                                </Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            client.type === 'investor'
                                                ? 'purple'
                                                : client.type === 'seller'
                                                ? 'orange'
                                                : 'blue'
                                        }
                                    >
                                        {client.type}
                                    </Badge>
                                </Td>
                                <Td>{client.properties}</Td>
                                <Td fontWeight="bold" color="green.600">
                                    {client.totalValue}
                                </Td>
                                <Td fontSize="sm">{client.realtorAssigned}</Td>
                                <Td fontSize="sm">{client.joinDate}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            client.status === 'active'
                                                ? 'green'
                                                : client.status === 'pending'
                                                ? 'yellow'
                                                : 'gray'
                                        }
                                    >
                                        {client.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View client"
                                        />
                                        <IconButton
                                            icon={<FileText size={16} />}
                                            size="sm"
                                            colorScheme="purple"
                                            variant="ghost"
                                            aria-label="View documents"
                                        />
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Edit client"
                                        />
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete client"
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

export default Clients;
